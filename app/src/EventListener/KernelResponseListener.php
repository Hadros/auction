<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

#[AsEventListener(method: 'onKernelResponse', priority: 42)]
class KernelResponseListener
{

    public function onKernelResponse(ResponseEvent $event): void
    {

    }

}
