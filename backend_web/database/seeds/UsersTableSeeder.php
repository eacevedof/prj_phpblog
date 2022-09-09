<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        User::create([
            "name"  => "Eduardo",
            "email" => "eacevedof@hotmail.com",
            "password" => bcrypt("SuperMan--"),
        ]);
    }
}

//php artisan db:seed --class=UsersTableSeeder
