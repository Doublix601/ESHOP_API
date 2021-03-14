<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategorieRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
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


class ApiCategoryController extends AbstractController
{
    // --- GET ---
    //Lire les catégories

    /**
     * @Route("/api/categories/get", name="api_category_all", methods={"GET"})
     */
    public function all(CategoryRepository $categoryRepository)
    {
        return $this->json($categoryRepository->findAll(),200,[], ['groups' => 'category:read']);
    }

    /**
     * @Route("/api/category/get/id/{id}", name="api_category_byid", methods={"GET"})
     */
    public function byid(ProductRepository $productRepository,$id)
    {
        return $this->json($productRepository->findBy(array('id' => $id)),200,[], ['groups' => 'category:read']);
    }

    
    // --- POST ---
    /**
     * @Route("/api/category/post", name="api_category_store", methods={"POST"})
     */
    public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator){
        $jsonRecu = $request->getContent();

        try{
            $user = $serializer->deserialize($jsonRecu, Product::class, 'json');

            $errors = $validator->validate($user);

            if(count($errors) > 0){
                return $this->json($errors, 400);
            }

            $em->persist($user);
            $em->flush();

            return $this->json($user, 201, [], ['groups' => 'category:read']);

        }catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }

    }

}
