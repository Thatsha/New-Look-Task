<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Admin'),
            array('name' => 'Customer'),
            array('name' => 'Guest Vendor'),
            array('name' => 'Vendor'),
            array('name' => 'Vendor Manager'),
        );
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \Spatie\Permission\Models\Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($data as $d) {
            \Spatie\Permission\Models\Role::create($d);
        }

        $user = User::find(1);

        $obj=$user?$user:new User();
        $obj->name="admin";
        $obj->email="admin@gmail.com";
        $obj->phone="0771234567";
        $obj->password=bcrypt('qwerty');;
        $obj->save();
        $obj->assignRole('Admin');
    }
}
