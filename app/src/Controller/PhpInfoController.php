<?php

namespace App\Controller;

use App\Message\SmsNotification;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class PhpInfoController extends AbstractController
{

    #[Route('/phpinfo', name: 'phpinfo')]
    public function index(): Response
    {
        return new Response(phpinfo());
    }
}
