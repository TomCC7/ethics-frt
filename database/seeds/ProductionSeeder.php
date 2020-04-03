<?php

use Illuminate\Database\Seeder;
use App\User;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->times(2)->create();
        $admin=User::first();
        $admin->email = 'admin@site';
        $admin->is_admin = true;
        $admin->name = 'Admin';
        $admin->last_name = 'Admin';
        $admin->password = bcrypt('admin');
        $admin->save();
        $user=User::Find(2);
        $user->email = 'user@test';
        $user->name = 'User';
        $user->last_name = 'User';
        $user->password = bcrypt('user');
        $user->save();
    }
}
