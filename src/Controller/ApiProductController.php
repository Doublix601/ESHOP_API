<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class ApiProductController extends AbstractController
{
    // --- GET ---
    //Lire les produits

    /**
     * @Route("/api/products/get", name="api_product_all", methods={"GET"})
     */
    public function all(ProductRepository $productRepository)
    {
        return $this->json($productRepository->findAll(),200,[], ['groups' => 'product:read']);
    }

    /**
     * @Route("/api/product/get/id/{id}", name="api_product_byid", methods={"GET"})
     */
    public function byid(ProductRepository $productRepository,$id)
    {
        return $this->json($productRepository->findBy(array('id' => $id)),200,[], ['groups' => 'product:read']);
    }


    // --- POST ---
    /**
     * @Route("/api/product/post", name="api_product_store", methods={"POST"})
     */
    public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator){
        $jsonRecu = $request->getContent();

        try{
            $product = $serializer->deserialize($jsonRecu, Product::class, 'json');

            $product->setCategory('Sweat');

            $product->setDeliveryOption('test');
            $product->setDeliveryPrice(50.15);

            $errors = $validator->validate($product);

            if(count($errors) > 0){
                return $this->json($errors, 400);
            }

            $em->persist($product);
            $em->flush();

            return $this->json($product, 201, [], ['groups' => 'product:read']);

        }catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }

    }

}
