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
            $adminRole = Role::create([
                'name' => 'Admin',
                'slug' => 'admin'
            ]);

            $user = User::findOrFail(1);
            $user->attachRole($adminRole);

            $privilegions = array(
                config('adminamazing.path'),
                config('adminamazing.path')."/adminrole"
            );

            \DB::table('admin__sections')->insert(
                ['name' => 'admin', 'privilegion' => json_encode($privilegions)]
            );
    	}
    }
}
