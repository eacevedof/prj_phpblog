<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
//parece que esta clase ya no existe en laravel 8
use \Mail;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function tesBasicTest()
    {
        $this->assertTrue(true);
    }

    public function test_mail()
    {
        $to_name = "Para Mi mismo";
        $to_email = "xxx@yyy.es";

        $data = array("name"=>"Ogbonna Vitalis(sender_name)", "body" => "A test mail");

        Mail::send("emails.test", $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject("Laravel Test Mail");
            $message->from("noreply@x.com","Test Mail");
        });
    }
}
