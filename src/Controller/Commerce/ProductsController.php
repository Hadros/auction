<?php

namespace App\Controller\Commerce;

use App\Entity\Commerce\Product;
use App\Repository\Commerce\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProductsController extends AbstractController
{
    #[Route('/dashboard/products', name: 'app_commerce_products')]
    #[IsGranted('ROLE_USER')]
    public function index(ManagerRegistry $doctrine): Response
    {
        /** @var ProductRepository $productRepository */
        $productRepository = $doctrine->getRepository(Product::class);
        $products = $productRepository->findByUser($this->getUser());
        return $this->render('commerce/products/index.html.twig', [
            'controller_name' => 'ProductsController',
            'products' => $products,
        ]);
    }
}
