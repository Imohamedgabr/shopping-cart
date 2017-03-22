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
        $user = new User();
        $user->name = "mohamed gabr";
        $user->email = "imohamedgabr@outlook.com";
        $user->password = crypt("secret","");
        $user->save();
    }
}
