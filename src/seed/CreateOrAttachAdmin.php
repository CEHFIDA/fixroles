<?php

use Illuminate\Database\Seeder;
use Selfreliance\adminrole\AdminRoleController;
use Selfreliance\fixroles\Models\Role;
use App\User;

class CreateOrAttachAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if(!AdminRoleController::checkExitsRole('Admin')) // if role is not created
    	{
            $adminRole = Role::create([
                'name' => 'Admin',
                'slug' => 'admin'
            ]);

            $user = User::findOrFail(1);
            $user->attachRole($adminRole);

            DB::table('admin__section')->insert(
                ['name' => 'admin', 'privilegion' => ["admin", "admin/adminrole", "admin/feedback", "admin/blog", "admin/users", "admin/tickets"]]
            );
    	}
    }
}
