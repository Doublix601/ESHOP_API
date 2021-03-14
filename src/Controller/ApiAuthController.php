<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
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


class ApiAuthController extends AbstractController
{
    // --- GET ---
    //Lire les utilisateurs

    /**
     * @Route("/api/users/login", name="ApiLogin", methods={"POST"})
     */
    public function login(UserRepository $userRepository)
    {
        return $this->json($userRepository->findOneBy(array('email' => "arnaud.doublix@gmail.com", 'password' => '$2y$13$teV/dYWdqxO1KtgOOp4CC.Tttud27T/QM9NFZ/06SLufrl6ixDwMW')),200,[], ['groups' => 'user:read']);
    }

    
    // --- POST --
    /**
     * @Route("/api/user/get", name="ApiSignup", methods={"POST"})
     */
    public function signup(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator){
        $jsonRecu = $request->getContent();

        try{
            $user = $serializer->deserialize($jsonRecu, User::class, 'json');

            $errors = $validator->validate($user);

            if(count($errors) > 0){
                return $this->json($errors, 400);
            }

            $em->persist($user);
            $em->flush();

            return $this->json($user, 201, [], ['groups' => 'user:read']);

        }catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }

    }

    // --- DELETE ---
    /**
     * @Route("/api/user/delete/id/{id}", name="delete_api_user_byid", methods={"GET"})
     */
    public function deletebyid(UserRepository $userRepository,$id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('id' => $id));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirect('http://localhost:8000/usersview');
        //return new Response("Utilisateur supprimé");
    }

}
