<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \DB::table('role_user')->delete();
	    \DB::table('permission_role')->delete();

	    //create a user
	    $sdi = User::create([
		    'name' => 'sdi',
		    'email' => 'fimo.sdi@gmail.com',
		    'password' => bcrypt('fimo!54321'),
		    'activated' => 1,
	    ]);

	    //create a role of admin
	    $admin = Role::create([
		    'name' => 'admin',
		    'display_name' => 'Admin',
		    'description' => 'Only one and only admin',
	    ]);

	    //create a permission for role
	    $manage_users = Permission::create([
		    'name' => 'manage-users-roles-and-permissions',
		    'display_name' => 'Manage Users,Roles and Permissions',
		    'description' => 'Can manage users,roles and permission"s',
	    ]);

	    //here attaching permission for admin role
	    $admin->attachPermission($manage_users);

		//here attaching role for user
	    $sdi->attachRole($admin);

	    $role_create = Role::create([
		    'name' => 'role-create',
		    'display_name' => 'RoleCreate',
		    'description' => 'Create Role',
	    ]);
	    $permission_create = Permission::create([
		    'name' => 'role-list',
		    'display_name' => 'RoleList',
		    'description' => 'Role List',
	    ]);
	    $role_create->attachPermission($permission_create);
	    $sdi->attachRole($role_create);

	    $application = Role::create([
		    'name' => 'appapirequestlogs',
		    'display_name' => 'AppApiRequestLogs',
		    'description' => 'This has full control on Application Core Request logs',
	    ]);
	    $corereq = Permission::create([
		    'name' => 'appapireqlogindex',
		    'display_name' => 'AppApiReqLogIndex',
		    'description' => 'This has control on Application Core Request Logs index only',
	    ]);
	    // here attaching roles and permissions
            $application->attachPermission($corereq);
            $sdi->attachRole($application);

	    $owner = Role::create([
	    	'name' => 'owner',
		    'display_name' => 'Project Owner',
		    'description' => 'User is the owner of a given project'
	    ]);

	    $create_post = Permission::create([
	    	'name' => 'create-post',
		    'display_name' => 'Create Posts',
		    'description' => 'Create new post'
	    ]);

	    $edit_user = Permission::create([
	    	'name' => 'edit_user',
		    'display_name' => 'Edit User',
		    'description' => 'Edit info User'
	    ]);
    }
}
