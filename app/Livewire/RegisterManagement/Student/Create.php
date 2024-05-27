<?php

namespace App\Livewire\RegisterManagement\Student;

use App\Models\City;
use App\Models\District;
use App\Models\Domicile;
use App\Models\Education;
use App\Models\Province;
use App\Models\Region;
use App\Models\RegisterManagement\Diniyah;
use App\Models\RegisterManagement\Formal;
use App\Models\RegisterManagement\Guardian;
use App\Models\RegisterManagement\Registration;
use App\Models\RegisterManagement\Status;
use App\Models\RegisterManagement\Student;
use App\Models\Scopes\GenderScope;
use App\Models\SettingManagement\Institution;
use App\Models\Village;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public $editMode = false;
    public $studentId;
    public object $educations;
    public object $domiciles;
    public object $diniyahs;
    public object $formals;
    public object $formal;
    public object $regions;
    public object $provinces;
    public object $cities;
    public object $districts;
    public object $villages;

    public $selectedRegion = null;
    public $selectedProvince = null;
    public $selectedCity = null;
    public $selectedDistrict = null;
    public $selectedVillage = null;
    public $switchAddress = 0;
    public $address = null;
    public $region;

    #[Validate]
    public $guardianId;
    public $guardianRelationship;
    public $kk;
    public $nik;
    public $name;
    public $gender;
    public $placeOfBirth;
    public $dateOfBirth;
    public $lastEducation;
    public $domicileStatus;
    public $domicileNumber;
    public $domicile;
    public $isNewDomicile;
    public $gradeOfDiniyah;
    public $institutionOfDiniyah;
    public $isNewDiniyah;
    public $gradeOfFormal;
    public $institutionOfFormal;
    public $isNewFormal;
    public $father;
    public $mother;

    public function rules()
    {
        if (!$this->editMode) {
            return [
                'guardianId' => 'required|min:8|max:8|exists:guardians,id',
                'guardianRelationship' => 'required',
                'kk' => 'required|min:16|max:16',
                'nik' => 'required|min:16|max:16|unique:students,nik',
                'name' => 'required',
                'gender' => 'required',
                'placeOfBirth' => 'required',
                'dateOfBirth' => 'required',
                'lastEducation' => 'required',
                'domicileStatus' => 'required',
                'domicileNumber' => 'required_if:domicileStatus,=,0',
                'domicile' => 'required_if:domicileStatus,=,0',
                'isNewDomicile' => 'required',
                'gradeOfDiniyah' => 'required',
                'institutionOfDiniyah' => 'required',
                'isNewDiniyah' => 'required',
                'gradeOfFormal' => 'required',
                'institutionOfFormal' => 'required',
                'isNewFormal' => 'required',
                'father' => 'required',
                'mother' => 'required'
            ];
        }

        return [
            'guardianId' => 'required|min:8|max:8|exists:guardians,id',
            'guardianRelationship' => 'required',
            'kk' => 'required|min:16|max:16',
            'nik' => 'required|min:16|max:16|unique:students,nik,'.$this->studentId,
            'name' => 'required',
            'gender' => 'required',
            'placeOfBirth' => 'required',
            'dateOfBirth' => 'required',
            'lastEducation' => 'required',
            'domicileStatus' => 'required',
            'domicileNumber' => 'required_if:domicileStatus,=,0',
            'domicile' => 'required_if:domicileStatus,=,0',
            'gradeOfDiniyah' => 'required',
            'institutionOfDiniyah' => 'required',
            'gradeOfFormal' => 'required',
            'institutionOfFormal' => 'required',
            'father' => 'required',
            'mother' => 'required'
        ];
    }

    public function render()
    {
        return view('livewire.register-management.student.create');
    }

    #[On('success_store')]
    public function mount(): void
    {
        $gender = session()->get('gender_access');

        $this->educations = Education::query()->get();
        $this->domiciles = Domicile::query()->where('gender', $gender)->get();
        $this->diniyahs = Institution::query()->whereIn('gender_access', [$gender, 2])
            ->where(['status' => 0, 'status_access' => 1])->get();
        $this->formals = Institution::query()->whereIn('gender_access', [$gender, 2])
            ->where(['status' => 0, 'status_access' => 2])->get();
        $this->regions = Region::query()->get();
        $this->provinces = Province::query()->get();
    }

    public function updatedSelectedRegion(): void
    {
        $this->selectedProvince = null;
        $this->region = $this->selectedRegion;
    }

    public function updatedSelectedProvince($province): void
    {
        $this->cities = City::query()->where('province_id', $province)->get();
        $this->selectedCity = null;
        $this->selectedDistrict = null;
        $this->selectedVillage = null;
    }

    public function updatedSelectedCity($city): void
    {
        $this->districts = District::query()->where('city_id', $city)->get();
        $this->selectedDistrict = null;
        $this->selectedVillage = null;
    }

    public function updatedSelectedDistrict($district): void
    {
        $this->villages = Village::query()->where('district_id', $district)->get();
    }

    #[On('submit')]
    public function store()
    {
        $this->validate();

        if ($this->gender != session()->get('gender_access')) {
            $this->dispatch('error', 'Akses gender tidak valid');
            return;
        }

        if (!$this->switchAddress) {
            if ($this->address == '') {
                $this->dispatch('error', 'Alamat tidak valid');
                return;
            }

            if (is_null($this->selectedRegion) && is_null($this->selectedVillage)) {
                $this->dispatch('error', 'Pinpoint tidak valid');
                return;
            }

            $checkRegion = checkRegion(
                $this->region,
                $this->selectedVillage,
                $this->selectedDistrict,
                $this->selectedCity,
                $this->selectedProvince
            );

            if ($checkRegion['status']){
                $this->region = $checkRegion['region'];
            }
        }else{
            $guardian = Guardian::query()->find($this->guardianId);
            $this->address = $guardian->address;
            $this->region = $guardian->region_id;
        }

        DB::transaction(function () {
            $hijri = session('hijri');
            $period = Auth::user()->current_period;
            $explode = explode('-', $hijri);
            $prefix = Str::substr($explode[0], 2, 2).$explode[1].$explode[2];
            $id = IdGenerator::generate(['table' => 'students', 'length' => 8, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);

            if (!$this->domicileStatus) {
                $this->domicileNumber = 1;
                $this->domicile = 'Rumah Orang Tua';
            }

            $lastStudent = Student::query()->withoutGlobalScope(GenderScope::class)->latest()->first();
            if ($lastStudent) {
                $reg = $lastStudent->registration_number + 1;
            }else{
                $reg = 3063;
            }

            $data = [
                'gender' => $this->gender,
                'period_id' => $period,
                'nik' => $this->nik,
                'kk' => $this->kk,
                'name' => Str::upper($this->name),
                'place_of_birth' => Str::title($this->placeOfBirth),
                'date_of_birth' => date('Y-m-d', strtotime($this->dateOfBirth)),
                'address' => $this->address,
                'region_id' => $this->region,
                'last_education' => $this->lastEducation,
                'domicile_status' => $this->domicileStatus,
                'domicile' => $this->domicile,
                'domicile_number' => $this->domicileNumber,
                'grade_of_diniyah' => $this->gradeOfDiniyah,
                'institution_diniyah_id' => $this->institutionOfDiniyah,
                'grade_of_formal' => $this->gradeOfFormal,
                'institution_formal_id' => $this->institutionOfFormal,
                'father' => Str::upper($this->father),
                'mother' => Str::upper($this->mother),
                'guardian_id' => $this->guardianId,
                'guardian_relationship' => $this->guardianRelationship,
            ];

            if ($this->editMode) {
                $student = Student::query()->find($this->studentId);
                foreach ($data as $k => $v) {
                    $student->$k = $v;
                }
                $student->save();

                $this->dispatch('success_store', '');
                $this->dispatch('success-swal-created', $this->studentId);
            } else {
                $data['id'] = $id;
                $data['registration_number'] = $reg;
                $data['committee'] = (session()->get('gender_access') == 0) ? 'MUH. SHOBIRIN' : 'SITI ROHMAH';
                $data['created_at_hijri'] = $hijri;
                $data['status'] = 1;
                Student::query()->create($data);

                //Add to domicile registration
                \App\Models\RegisterManagement\Domicile::query()->create([
                    'period_id' => $period,
                    'student_id' => $id,
                    'domicile_status' => $this->domicileStatus,
                    'domicile' => $this->domicile,
                    'domicile_number' => $this->domicileNumber,
                    'is_new' => $this->isNewDomicile,
                    'note' => 'Proses awal registrasi',
                    'created_at_hijri' => $hijri
                ]);

                //Add to diniyah registration
                Diniyah::query()->create([
                    'period_id' => $period,
                    'student_id' => $id,
                    'grade' => $this->gradeOfDiniyah,
                    'institution_id' => $this->institutionOfDiniyah,
                    'is_new' => $this->isNewDiniyah,
                    'note' => 'Proses awal registrasi',
                    'created_at_hijri' => $hijri
                ]);

                //Add to formal registration
                Formal::query()->create([
                    'period_id' => $period,
                    'student_id' => $id,
                    'grade' => $this->gradeOfFormal,
                    'institution_id' => $this->institutionOfFormal,
                    'is_new' => $this->isNewFormal,
                    'note' => 'Proses awal registrasi',
                    'created_at_hijri' => $hijri
                ]);

                //Add to status registration
                Status::query()->create([
                    'period_id' => $period,
                    'student_id' => $id,
                    'status' => 1,
                    'note' => 'Proses awal registrasi',
                    'created_at_hijri' => $hijri
                ]);

                //Add to registration
                Registration::query()->create([
                    'id' => $id,
                    'domicile_status' => $this->domicileStatus,
                    'domicile' => $this->domicile,
                    'domicile_number' => $this->domicileNumber,
                    'is_new_domicile' => $this->isNewDomicile,
                    'grade_of_diniyah' => $this->gradeOfDiniyah,
                    'institution_diniyah_id' => $this->institutionOfDiniyah,
                    'is_new_diniyah' => $this->isNewDiniyah,
                    'grade_of_formal' => $this->gradeOfFormal,
                    'institution_formal_id' => $this->institutionOfFormal,
                    'is_new_formal' => $this->isNewFormal,
                    'created_at_hijri' => hijri()
                ]);

                $this->dispatch('success_store', '');
                $this->dispatch('success-swal-created', $data['id']);
            }

            $this->switchAddress = false;
            $this->reset();
        });
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('reset')]
    public function resetElement(): void
    {
        $this->switchAddress = false;
        $this->reset();
        $this->mount();
    }

    #[On('edit_student')]
    public function editStudent($id): void
    {
        $this->studentId = $id;
        $this->editMode = true;
        $student = Student::query()->find($id);

        $this->switchAddress = false;

        $this->guardianId = $student->guardian_id;
        $this->guardianRelationship = $student->guardian_relationship;
        $this->kk = $student->kk;
        $this->nik = $student->nik;
        $this->name = $student->name;
        $this->gender = $student->gender;
        $this->placeOfBirth = $student->place_of_birth;
        $this->dateOfBirth = date('d-m-Y', strtotime($student->date_of_birth));
        $this->lastEducation = $student->last_education;
        $this->domicileStatus = $student->domicile_status;
        $this->domicile = $student->domicile;
        $this->domicileNumber = $student->domicile_number;
        $this->gradeOfDiniyah = $student->grade_of_diniyah;
        $this->institutionOfDiniyah = $student->institution_diniyah_id;
        $this->gradeOfFormal = $student->grade_of_formal;
        $this->institutionOfFormal = $student->institution_formal_id;
        $this->father = $student->father;
        $this->mother = $student->mother;
        $this->address = $student->address;
        $this->region = $student->region_id;
    }
}
