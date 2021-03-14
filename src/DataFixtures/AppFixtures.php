<?php

namespace App\DataFixtures;

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
        $getCategory = $manager->getRepository(Category::class)->findOneBy(array('id'=>mt_rand(1, 3)));

        // $product = new Product();
        // $manager->persist($product);

        // Create categories
        $category = new Category();
        $category->setName('T-shirt');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Sweat');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Polo');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Pantalon');
        $manager->persist($category);

        // Delivery options
        // Option 1
        $delivery = new Delivery();
        $delivery->setType('Standard');
        $delivery->setDeliveryTime(4);
        $delivery->setPrice(5);
        $manager->persist($delivery);

        // Option 2
        $delivery = new Delivery();
        $delivery->setType('Rapide');
        $delivery->setDeliveryTime(2);
        $delivery->setPrice(9.99);
        $manager->persist($delivery);

        // Option 3
        $delivery = new Delivery();
        $delivery->setType('Livraison en 1 jour');
        $delivery->setDeliveryTime(1);
        $delivery->setPrice(15);
        $manager->persist($delivery);

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
            $product->setCategory($getCategory);
            $product->setDeliveryOption('Standard');
            $product->setDescriptionCourte('Ceci est la description courte du produit n°'.$i);
            $product->setEcotax('0.05');
            $product->setTtcPrice(mt_rand(10, 100));
            $product->setStock(mt_rand(1, 20));
            $product->setDeliveryPrice('5');
            $product->setDiscount('0');

            $manager->persist($product);
        }

        //$order = new Order();

        //$order->persist($order);

        $manager->flush();
    }
}
