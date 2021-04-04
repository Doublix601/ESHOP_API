<?php

namespace App\DataFixtures;

use App\Entity\Adress;
use App\Entity\Category;
use App\Entity\Delivery;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AppFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        // Create 20 products
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setNbVentes(mt_rand(10, 100));
            $product->setLabel('product '.$i);
            $product->setHtPrice(mt_rand(10, 100));
            $product->setDescription('Ceci est la description du produit n°'.$i.'. Plus tard il y aura une description réelle du produit vendu dans le shop.');
            $product->setBrand('Marque de test');
            $product->setImg("/assets/img/site/404_products.png");
            $product->setTva('20');
            $product->setDescriptionCourte('Ceci est la description courte du produit n°'.$i);
            $product->setTtcPrice(mt_rand(10, 100));
            $product->setStock(mt_rand(1, 20));

            $manager->persist($product);
        }

        //$order = new Order();

        //$order->persist($order);

        $manager->flush();
    }
}
