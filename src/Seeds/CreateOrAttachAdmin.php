<?php

use Illuminate\Database\Seeder;
use Selfreliance\adminrole\AdminRoleController;
use Selfreliance\fixroles\Models\Role;
use App\User;
use Config as config;

class CreateOrAttachAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if(!AdminRoleController::checkExistRole('Admin')) // if role is not created
    	{
            $accessible = array(
                config('adminamazing.path'),
                "adminrole",
                "adminmenu"
            );

            $adminRole = Role::create([
                'name' => 'Admin',
                'slug' => 'admin',
                'accessible_pages' => json_encode($accessible)
            ]);

            $user = User::findOrFail(1);
            $user->attachRole($adminRole);
            
            \DB::table('admin__menu')->insert([
                ['title' => 'Меню', 'package' => 'adminmenu', 'parent' => 0, 'sort' => 0],
                ['title' => 'Роли', 'package' => 'adminrole', 'parent' => 0, 'sort' => 1]
            ]);
    	}
    }
}
