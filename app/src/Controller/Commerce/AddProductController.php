<?php

namespace App\Controller\Commerce;

use App\Entity\Commerce\Product;
use App\Entity\User\User;
use App\Form\Commerce\AddProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AddProductController extends AbstractController
{
    #[Route('/dashboard/products/add', name: 'app_commerce_add_product')]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gavno = 1;
        $product = new Product();
        $form = $this->createForm(AddProductFormType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $now = new \DateTime('now');
            $product->setCreated($now);
            $product->setChanged($now);
            /** @var User $user */
            $user = $this->getUser();
            $product->setUser($user);
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_commerce_products');
        }

        return $this->render('commerce/add_product/index.html.twig', [
            'addProductForm' => $form->createView(),
        ]);
    }
}
