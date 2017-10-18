<?php

use Illuminate\Database\Seeder;
use Selfreliance\adminrole\AdminRoleController;
use Selfreliance\fixroles\Models\Role;
use App\User;
use DB;
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
    	if(!AdminRoleController::checkExistRole('admin')) // if role is not created
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

            $user = User::findOrFail(19);
            $user->attachRole($adminRole->id);
            
            DB::table('admin__menu')->insert([
                ['title' => 'Заголовок', 'package' => 'none', 'icon' => '', 'parent' => 0, 'sort' => 0],
                ['title' => 'Меню', 'package' => 'adminmenu', 'icon' => 'mdi mdi-menu', 'parent' => 0, 'sort' => 1],
                ['title' => 'Роли', 'package' => 'adminrole', 'icon' => 'mdi mdi-key', 'parent' => 0, 'sort' => 2]
            ]);
    	}
    }
}