<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function test_mail()
    {
        $to_name = "Para Mi mismo";
        $to_email = "";
        $data = array("name"=>"Ogbonna Vitalis(sender_name)", "body" => "A test mail");
        Mail::send("emails.mail", $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject("Laravel Test Mail");
            $message->from("SENDER_EMAIL_ADDRESS","Test Mail");
        });
    }
}
