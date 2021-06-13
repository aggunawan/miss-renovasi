<?php

namespace App\Models;

use BenSampo\Enum\Traits\CastsEnums;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use CastsEnums;
    use CrudTrait;
    use HasFactory;
    use HasRoles;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function getRolesArray()
    {
        return $this->roles()->pluck('name');
    }

    public function getRoles()
    {
        $roles = $this->getRolesArray()->join(', ');

        return strlen($roles) == 0 ? 'Unassign' : $roles;
    }
}
