<?php

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserService
{
    public function store(array $userData)
    {
        DB::beginTransaction();
        try{
            $password = Str::random(6);

            $newUser = User::create([
                'full_name' => $userData['full_name'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'password' => Hash::make($password),
                'status' => $userData['status'],
            ]);

            $newUser->assignRole($userData['roles']);

            if (request()->has('user_image') && request('user_image') != null) {
                $newUser->addMediaFromRequest('user_image')->toMediaCollection('avatar');
            }

            // If all good then store all the records to the relivent table
            DB::commit();

            // TODO:: send mail after creating a/c to user

            return true;
        } catch (QueryException $e) {
            //database related exception
            DB::rollBack();
            return $e->errorInfo[2];
        } catch (\Exception $e) {
            //general exception
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function update(array $userData, int $id)
    {
        DB::beginTransaction();
        try{
            $user = User::findOrFail($id);
            $userRoles = $user->getRoleNames()->toArray();
            if(!in_array($userData['roles'], $userRoles)){
                // $user->removeRole();
                // Remove previous roles
                $user->roles()->detach();

                // Assign new role
                $role = Role::where('name', $userData['roles'])->firstOrFail();
                $user->assignRole($role);
            }

            $updatedUser = $user->update([
                'full_name' => $userData['full_name'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'status' => $userData['status'],
            ]);

            if (request()->has('user_image') && request('user_image') != null) {
                $user->addMediaFromRequest('user_image')->toMediaCollection('avatar');
            }

            // If all good then store all the records to the relivent table
            DB::commit();
            return true;
        } catch (QueryException $e) {
            //database related exception
            DB::rollBack();
            return $e->errorInfo[2];
        } catch (\Exception $e) {
            //general exception
            DB::rollBack();
            return $e->getMessage();
        }
    }
}