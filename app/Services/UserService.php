<?php
namespace App\Services;


use App\Models\Role;
use App\User;

class UserService
{

    public function getUsersForListing()
    {
        return User::all();
    }

    public function getUserForEdit($id)
    {
        return User::find($id);
    }

    public function deleteUser($id)
    {
        return User::find($id)->delete();
    }

    public function createUser($name, $email, $password, $role)
    {

        // Check that user with the same email does not exist
        if (!$this->isEmailUnique($email))
            return false;

        if ($this->createUserInDatabase($name, $email, $password,$role))
            return true;

        return false;
    }

    public function updateUser($name, $email, $password, $role, $id)
    {
        if ($this->isUsersEmailUnique($email, $id))
        {
            $role = $role = Role::find($role)->first();
            $user = User::find($id);
            $user->name = $name;
            $user->email = $email;
            $user->role()->associate($role);

            // Handle password only if it was filled in in the administration
            // TODO: In real life, we should also probably check manager knows his/her password
            // TODO: Also, currently manager has no way of editing his/her password (or details)
            if (!empty($password))
                $user->password = bcrypt($password);

            return $user->save();
        }

        return false;
    }


    private function createUserInDatabase($name, $email, $password, $role)
    {
        $roleRecord = Role::find($role);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->role()->associate($roleRecord);
        return $user->save();
    }

    private function isEmailUnique($email)
    {
        return empty(User::where('email', $email)->first());
    }

    private function isUsersEmailUnique($email, $userId)
    {
        return empty(User::where('email', $email)->where('id', '<>', $userId)->first());
    }
}