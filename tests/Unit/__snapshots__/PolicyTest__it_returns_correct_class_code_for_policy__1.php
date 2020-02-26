<?php return '<?php

namespace App\\Policies;

use App\\Credential;
use App\\User;
use Illuminate\\Auth\\Access\\HandlesAuthorization;

class CredentialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any credentials.
     *
     * @param  \\App\\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->application_role == \'APPADMIN\';
    }

    /**
     * Determine whether the user can view the credential.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Credential  $credential
     * @return mixed
     */
    public function view(User $user, Credential $credential)
    {
        //
    }

    /**
     * Determine whether the user can create credentials.
     *
     * @param  \\App\\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the credential.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Credential  $credential
     * @return mixed
     */
    public function update(User $user, Credential $credential)
    {
        return $user->application_role === \'APPADMIN\';
    }

    /**
     * Determine whether the user can delete the credential.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Credential  $credential
     * @return mixed
     */
    public function delete(User $user, Credential $credential)
    {
        //
    }

    /**
     * Determine whether the user can restore the credential.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Credential  $credential
     * @return mixed
     */
    public function restore(User $user, Credential $credential)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the credential.
     *
     * @param  \\App\\User  $user
     * @param  \\App\\Credential  $credential
     * @return mixed
     */
    public function forceDelete(User $user, Credential $credential)
    {
        //
    }
}
';
