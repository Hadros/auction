<?php

namespace App\Controller\Commerce;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarketController extends AbstractController
{
    #[Route('/commerce/market', name: 'app_commerce_market')]
    public function index(): Response
    {
        return $this->render('commerce/market/index.html.twig', [
            'controller_name' => 'MarketController',
        ]);
    }
}
