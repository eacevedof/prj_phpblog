<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;
//use Illuminate\Support\Str;
use App\Models\AppPost;

//post faker
$factory->define(AppPost::class, function (Faker $faker) {
    $images = [
        "https://resources.theframework.es/eduardoaf.com/20200904/181546-post.jpg",
        "https://resources.theframework.es/eduardoaf.com/20200904/185556-post-2.jpg",
        "https://resources.theframework.es/eduardoaf.com/20200904/185556-post-3.jpg",
        "https://resources.theframework.es/eduardoaf.com/20200904/185731-post-4.jpg",
    ];

    return [
        'description' => $faker->text,
        "title" => $faker->text,
        "url_final"=>$faker->slug,
        "content" => $faker->text,
        //"excerpt" => $faker->words(500).join(" "),
        "url_img1" => $faker->randomElement($images),
        "id_status" => $faker->numberBetween(0,1),
        "excerpt" => $faker->text,
        "publish_date"=> $faker->dateTime(),
    ];
});
