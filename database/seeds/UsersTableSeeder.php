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
        $admin = User::First();
        $admin->email = 'admin@site';
        $admin->is_admin = true;
        $admin->name = 'Admin';
        $admin->last_name = 'Admin';
        $admin->password = bcrypt('admin');
        $admin->save();
    }
}
