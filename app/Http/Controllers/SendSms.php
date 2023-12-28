<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vonage\Client\Credentials\Basic;
use Vonage\Client;
use Vonage\SMS\Message\SMS;

class SendSms extends Controller
{
    const BRAND_NAME = 'Norhan';

    public function sendSms()
    {
        $basic = new Basic("cfc31417", "lr88U2rAqj4pijDD");
        $client = new Client($basic);

        $response = $client->sms()->send(
            new SMS("201003244268", self::BRAND_NAME, '
           Ashtar Katkoot 🐥❤️')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
