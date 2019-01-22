<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('User')->truncate();
        factory(Appmax\Models\User::class)->create(
            [
                'Name' => 'Master',
                'Email' => 'master@gmail.com',
                'Password' => Hash::make(123456),
                'RememberToken' => str_random(10),
            ]
        );
        factory(Appmax\Models\User::class, 10)->create();
    }
}
