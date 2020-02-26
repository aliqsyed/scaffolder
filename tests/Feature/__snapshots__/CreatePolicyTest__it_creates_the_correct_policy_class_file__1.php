<?php return '<?php

namespace App\\Policies;

use App\\Testuser;
use App\\User;
use Illuminate\\Auth\\Access\\HandlesAuthorization;

class TestuserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any testusers.
     *
     * @param  \\App\\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->application_role == \'APPADMIN\';
    }

    /**
     * Determine whether the user can view the testuser.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Testuser  $testuser
     * @return mixed
     */
    public function view(User $user, Testuser $testuser)
    {
        //
    }

    /**
     * Determine whether the user can create testusers.
     *
     * @param  \\App\\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the testuser.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Testuser  $testuser
     * @return mixed
     */
    public function update(User $user, Testuser $testuser)
    {
        return $user->application_role === \'APPADMIN\';
    }

    /**
     * Determine whether the user can delete the testuser.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Testuser  $testuser
     * @return mixed
     */
    public function delete(User $user, Testuser $testuser)
    {
        //
    }

    /**
     * Determine whether the user can restore the testuser.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Testuser  $testuser
     * @return mixed
     */
    public function restore(User $user, Testuser $testuser)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the testuser.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Testuser  $testuser
     * @return mixed
     */
    public function forceDelete(User $user, Testuser $testuser)
    {
        //
    }
}
';
