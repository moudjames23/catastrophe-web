<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ville;
use Illuminate\Auth\Access\HandlesAuthorization;

class VillePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ville can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list villes');
    }

    /**
     * Determine whether the ville can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ville  $model
     * @return mixed
     */
    public function view(User $user, Ville $model)
    {
        return $user->hasPermissionTo('view villes');
    }

    /**
     * Determine whether the ville can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create villes');
    }

    /**
     * Determine whether the ville can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ville  $model
     * @return mixed
     */
    public function update(User $user, Ville $model)
    {
        return $user->hasPermissionTo('update villes');
    }

    /**
     * Determine whether the ville can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ville  $model
     * @return mixed
     */
    public function delete(User $user, Ville $model)
    {
        return $user->hasPermissionTo('delete villes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ville  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete villes');
    }

    /**
     * Determine whether the ville can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ville  $model
     * @return mixed
     */
    public function restore(User $user, Ville $model)
    {
        return false;
    }

    /**
     * Determine whether the ville can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ville  $model
     * @return mixed
     */
    public function forceDelete(User $user, Ville $model)
    {
        return false;
    }
}
