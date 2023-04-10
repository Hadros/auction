<?php

namespace App\DataFixtures;

use App\Entity\Commerce\Product;
use App\Entity\Commerce\ProductVariation;
use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher) {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        // Create admin
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('mr.hadros@gmail.com');
        $user->setIsVerified(true);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                'Morrowind89!',
            )
        );
        $manager->persist($user);

        for ($i = 2; $i < 5; $i++) {
            $user = new User();
            $user->setUsername('user' . $i);
            $user->setEmail('user' . $i . '@gmail.com');
            $user->setIsVerified(true);
            $user->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $user,
                    'VeryStrongPassword123!',
                )
            );
            $manager->persist($user);

            for ($j = 0; $j < 20; $j++) {
                $product = new Product();
                $product->setTitle('user' . $i . '\'s  product ' . $j);
                $product->setUser($user);
                $manager->persist($product);

                $productVariation = new ProductVariation();
                $productVariation->setPrice(rand(10, 100));
                $productVariation->setProduct($product);
                $manager->persist($productVariation);
            }
        }

        $manager->flush();
    }
}
