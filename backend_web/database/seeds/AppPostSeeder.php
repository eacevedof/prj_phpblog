<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppPost;

class AppPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        factory(AppPost::class, 100)->create();
    }
}

//php artisan db:seed --class=AppPostSeeder
