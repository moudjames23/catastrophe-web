<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Catastrophe;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatastrophePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the catastrophe can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list catastrophes');
    }

    /**
     * Determine whether the catastrophe can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Catastrophe  $model
     * @return mixed
     */
    public function view(User $user, Catastrophe $model)
    {
        return $user->hasPermissionTo('view catastrophes');
    }

    /**
     * Determine whether the catastrophe can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create catastrophes');
    }

    /**
     * Determine whether the catastrophe can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Catastrophe  $model
     * @return mixed
     */
    public function update(User $user, Catastrophe $model)
    {
        return $user->hasPermissionTo('update catastrophes');
    }

    /**
     * Determine whether the catastrophe can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Catastrophe  $model
     * @return mixed
     */
    public function delete(User $user, Catastrophe $model)
    {
        return $user->hasPermissionTo('delete catastrophes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Catastrophe  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete catastrophes');
    }

    /**
     * Determine whether the catastrophe can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Catastrophe  $model
     * @return mixed
     */
    public function restore(User $user, Catastrophe $model)
    {
        return false;
    }

    /**
     * Determine whether the catastrophe can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Catastrophe  $model
     * @return mixed
     */
    public function forceDelete(User $user, Catastrophe $model)
    {
        return false;
    }
}
