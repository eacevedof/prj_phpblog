<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\AppPost;

$factory->define(AppPost::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        "title" => $faker->text,
        "url_final"=>$faker->slug,
        "content" => $faker->text,
    ];
});
