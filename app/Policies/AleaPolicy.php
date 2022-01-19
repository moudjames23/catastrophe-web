<?php

namespace App\Policies;

use App\Models\Alea;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AleaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the alea can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list aleas');
    }

    /**
     * Determine whether the alea can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Alea  $model
     * @return mixed
     */
    public function view(User $user, Alea $model)
    {
        return $user->hasPermissionTo('view aleas');
    }

    /**
     * Determine whether the alea can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create aleas');
    }

    /**
     * Determine whether the alea can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Alea  $model
     * @return mixed
     */
    public function update(User $user, Alea $model)
    {
        return $user->hasPermissionTo('update aleas');
    }

    /**
     * Determine whether the alea can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Alea  $model
     * @return mixed
     */
    public function delete(User $user, Alea $model)
    {
        return $user->hasPermissionTo('delete aleas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Alea  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete aleas');
    }

    /**
     * Determine whether the alea can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Alea  $model
     * @return mixed
     */
    public function restore(User $user, Alea $model)
    {
        return false;
    }

    /**
     * Determine whether the alea can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Alea  $model
     * @return mixed
     */
    public function forceDelete(User $user, Alea $model)
    {
        return false;
    }
}
