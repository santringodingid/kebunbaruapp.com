<?php

namespace App\Livewire\RegisterManagement\Guardian;

use App\Models\City;
use App\Models\District;
use App\Models\Education;
use App\Models\Employment;
use App\Models\Province;
use App\Models\Region;
use App\Models\RegisterManagement\Guardian;
use App\Models\Village;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public $editMode = false;
    public $guardianId;
    public $address;
    public $region;
    public object $educations;
    public object $employments;
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
    #[Validate]
    public $nik;
    public $name;
    public $gender;
    public $phone;
    public $waNumber;
    public $lastEducation;
    public $employment;

    public function rules(): array
    {
        if ($this->editMode) {
             return [
                'nik' => 'required|max:16|min:16|unique:guardians,nik,'.$this->guardianId,
                'name' => 'required',
                'gender' => 'required',
                'phone' => 'required',
                'waNumber' => 'required',
                'lastEducation' => 'required',
                'employment' => 'required'
            ];
        }

        return [
            'nik' => 'required|max:16|min:16|unique:guardians,nik',
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'waNumber' => 'required',
            'lastEducation' => 'required',
            'employment' => 'required'
        ];
    }

    #[On('success_store')]
    public function mount(): void
    {
        $this->educations = Education::query()->get();
        $this->employments = Employment::query()->get();
        $this->regions = Region::query()->get();
        $this->provinces = Province::query()->get();
    }

    public function updatedSelectedRegion(): void
    {
        $this->selectedProvince = null;
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
    public function store(): void
    {
        $this->validate();

        $nik = str_replace('_', '', $this->nik);
        if (strlen($nik) < 16) {
            $this->dispatch('error', 'NIK harus berupa 16 digit');
            return;
        }

        if (is_null($this->address)) {
            $this->dispatch('error', 'Alamat jangan dibiarkan kosong');
            return;
        }

        if (is_null($this->selectedRegion) && is_null($this->selectedProvince)) {
            $this->dispatch('error', 'Pastikan pinpoit sudah dipilih');
            return;
        }

        if (!is_null($this->selectedRegion)) {
            $this->region = $this->selectedRegion;
        }

        if (!is_null($this->selectedProvince)) {
            if (is_null($this->selectedCity) || is_null($this->selectedDistrict) || is_null($this->selectedVillage)) {
                $this->dispatch('error', 'Pinpoin manual belum valid');
                return;
            }
        }

        DB::transaction(function (){
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

            $data = [
                'nik' => $this->nik,
                'name' => Str::upper($this->name),
                'gender' => $this->gender,
                'phone' => $this->phone,
                'wa_number' => $this->waNumber,
                'address' => Str::title($this->address),
                'region_id' => $this->region,
                'last_education' => $this->lastEducation,
                'employment' => $this->employment
            ];

            if ($this->editMode) {
                $guardian = Guardian::query()->find($this->guardianId);
                foreach ($data as $key => $value) {
                    $guardian->$key = $value;
                }
                $guardian->save();

                $this->dispatch('success_store', '');
                $this->dispatch('success-swal-updated', $this->guardianId);
            } else {
                $data['id'] = IdGenerator::generate(['table' => 'guardians', 'length' => 8, 'prefix' => 1391]);
                Guardian::query()->create($data);

                $this->dispatch('success_store', '');
                $this->dispatch('success-swal-created', $data['id']);
            }

        });

        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.register-management.guardian.create');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('reset')]
    public function resetElement(): void
    {
        $this->reset();
        $this->mount();
    }

    #[On('edit_guardian')]
    public function editGuardian($id): void
    {
        $this->guardianId = $id;
        $this->editMode = true;
        $guardian = Guardian::query()->find($id);

        $this->nik = $guardian->nik;
        $this->name = $guardian->name;
        $this->gender = $guardian->gender;
        $this->phone = $guardian->phone;
        $this->waNumber = $guardian->wa_number;
        $this->address = $guardian->address;
        $this->selectedRegion = $guardian->region_id;
        $this->lastEducation = $guardian->last_education;
        $this->employment = $guardian->employment;
    }
}
