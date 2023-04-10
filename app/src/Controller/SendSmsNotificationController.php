<?php

namespace App\Controller;

use App\Message\SmsNotification;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class SendSmsNotificationController extends AbstractController
{

    #[Route('/send-sms-notification', name: 'send_sms_notification')]
    public function index(MessageBusInterface $bus): Response
    {

        // will cause the SmsNotificationHandler to be called
        //$bus->dispatch(new SmsNotification('Look! I created a message!'));

        // ...
        return new Response('Hi!');
    }
}
