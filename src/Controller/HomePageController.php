<?php

namespace App\Controller;

use App\Entity\User\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{

    /**
     * @Route("/", name="home_page")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $this->addFlash('success', 'dsdsads');
        return $this->render('home_page.html.twig');
    }
}