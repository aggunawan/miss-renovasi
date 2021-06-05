<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role->is(Role::Administrator);
    }

    public function view(User $user, User $model)
    {
        return $user->role->is(Role::Administrator);
    }

    public function create(User $user)
    {
        return $user->role->is(Role::Administrator);
    }

    public function update(User $user, User $model)
    {
        return $user->role->is(Role::Administrator);
    }

    public function delete(User $user, User $model)
    {
        return $user->role->is(Role::Administrator);
    }

    public function restore(User $user, User $model)
    {
        return $user->role->is(Role::Administrator);
    }

    public function forceDelete(User $user, User $model)
    {
        return $user->role->is(Role::Administrator);
    }
}
