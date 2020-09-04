<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;
//use Illuminate\Support\Str;
use App\Models\AppPost;

$factory->define(AppPost::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        "title" => $faker->text,
        "url_final"=>$faker->slug,
        "content" => $faker->text,
        //"excerpt" => $faker->words(500).join(" "),
        "url_img1" => "https://resources.theframework.es/eduardoaf.com/20200904/181546-post.jpg",
        "excerpt" => $faker->text,
    ];
});
