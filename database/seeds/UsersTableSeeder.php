<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();
        User::insert($user_array);
        $s_admin = User::First();
        $s_admin->email = 'superadmin@site';
        $s_admin->is_admin = 2;
        $s_admin->name = 'SuperAdmin';
        $s_admin->last_name = 'SuperAdmin';
        $s_admin->password = bcrypt('superadmin');
        $s_admin->save();
        $admin = User::Find(2);
        $admin->email = 'admin@site';
        $admin->is_admin = 1;
        $admin->name = 'Admin';
        $admin->last_name = 'Admin';
        $admin->password = bcrypt('admin');
        $admin->save();
        $user = User::Find(3);
        $user->email = 'user@site';
        $user->name = 'User';
        $user->last_name = 'User';
        $user->password = bcrypt('user');
        $user->save();
    }
}
