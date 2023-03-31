<?php

namespace App\Controller\Commerce;

use App\Entity\Commerce\Product;
use App\Repository\Commerce\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\AbstractController;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Cache\ItemInterface;

class ProductsController extends AbstractController
{
    #[Route('/dashboard/products', name: 'app_commerce_products')]
    #[IsGranted('ROLE_USER')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $products = [];
        $pool = new FilesystemAdapter();
        try {
            $products = $pool->get('database.get_products', function (ItemInterface $item) use ($doctrine) {
                $item->expiresAfter(86400); // 1 day

                /** @var ProductRepository $productRepository */
                $productRepository = $doctrine->getRepository(Product::class);
                return $productRepository->findByUser($this->getUser());
            });
        }
        catch (InvalidArgumentException $exception) {
            // @TODO: log exception
        }

        return $this->render('commerce/products/index.html.twig', [
            'controller_name' => 'ProductsController',
            'products' => $products,
        ]);
    }
}
