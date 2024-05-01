<?php

namespace App\Livewire\UserManagement\User;

use App\Models\SettingManagement\Institution;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use WithFileUploads;

    public $user_id;
    #[Rule(['required', 'string'])]
    public string $name;
    #[Rule(['required', 'email'])]
    public string $email;
    #[Rule(['required'])]
    public int $institution;
    #[Rule(['required', 'string'])]
    public string $role;
    #[Rule(['nullable', 'sometimes', 'image', 'max:1024'])]
    public $avatar;
    public $saved_avatar;
    public bool $edit_mode = false;

    public function render(): View
    {
        $roles = Role::all();
        $institutions = Institution::all();

        $roles_description = [
            'administrator' => 'Badan Pengembangan Sistem dan Teknologi Informasi',
            'secretary' => 'Sekretaris dan staf di bawah koordinasi Sekretaris Umum',
        ];

        foreach ($roles as $i => $role) {
            $roles[$i]->description = $roles_description[$role->name] ?? '';
        }

        return view('livewire.user-management.user.create', compact(['roles', 'institutions']));
    }

    public function submit(): void
    {
        // Validate the form input data
        $this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new user
            $data = [
                'name' => Str::upper($this->name),
                'email_verified_at' => Carbon::now()
            ];

            if ($this->avatar) {
                $data['profile_photo_path'] = $this->avatar->store('avatars/users', 'public');
            } else {
                $data['profile_photo_path'] = null;
            }

            if (!$this->edit_mode) {
                $data['password'] = Hash::make('p2k1391');
            }

            // Update or Create a new user record in the database
            $data['email'] = $this->email;
            $data['username'] = $this->email;
            $data['institution_id'] = $this->institution;
            $user = User::find($this->user_id) ?? User::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $user->$k = $v;
                }
                $user->save();
            }

            if ($this->edit_mode) {
                // Assign selected role for user
                $user->syncRoles($this->role);

                // Emit a success event with a message
                $this->dispatch('success', __('User berhasil diupdate'));
            } else {
                // Assign selected role for user
                $user->assignRole($this->role);

                // Emit a success event with a message
                $this->dispatch('success', __('User baru berhasil ditambahkan'));
            }
        });

        // Reset the form fields after successful submission
        $this->reset();
    }

    #[On('delete_user')]
    public function deleteUser($id): void
    {
        // Prevent deletion of current user
        if ($id == Auth::id()) {
            $this->dispatch('error', 'User tidak bisa dihapus');
            return;
        }

        // Delete the user record with the specified ID
        User::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'User berhasil dihapus');
    }

    #[On('update_user')]
    public function updateUser($id): void
    {
        $this->edit_mode = true;

        $user = User::find($id);

        $this->user_id = $user->id;
        $this->saved_avatar = $user->profile_photo_path;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles?->first()->name ?? '';
        $this->institution = $user->institution_id;
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
    }
}
