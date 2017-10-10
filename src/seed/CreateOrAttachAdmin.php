<?php

use Illuminate\Database\Seeder;
use Selfreliance\adminrole\AdminRoleController;
use Selfreliance\fixroles\Models\Role;
use App\User;
use Config;

class CreateOrAttachAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if(!AdminRoleController::checkExitsRole('admin')) // if role is not created
    	{
            $accessible = array(
                config('adminamazing.path'),
                config('adminamazing.path')."/adminrole",
                config('adminamazing.path')."/adminmenu"
            );

            $adminRole = Role::create([
                'name' => 'Admin',
                'slug' => 'admin',
                'accessible_pages' => $accessible
            ]);

            $user = User::findOrFail(1);
            $user->attachRole($adminRole);
    	}
    }
}
