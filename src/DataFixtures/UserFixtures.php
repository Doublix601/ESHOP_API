<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;
use Faker\Generator;

class UserFixtures extends Fixture
{
    private $faker;

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        $this->addUsers($manager);

        $manager->flush();
    }

    public function addUsers(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();

            $firstname = $this->faker->firstName;
            $lastname = $this->faker->lastName;

            $user->setEmail($firstname.'.'.$lastname.'@gmail.com');
            $user->setPassword($this->encoder->encodePassword($user, 'admin'));
            $user->setRoles(['ROLE_USER']);
            $user->setFirstName($firstname);
            $user->setLastName($lastname);
            $user->setAdress('39 rue de la fontaine saint martin');
            $user->setCp('60350');
            $user->setCity('Attichy');
            $user->setCountry('France');

            $manager->persist($user);
        }

        $user = new User();

        $user->setEmail('arnaud.doublix@gmail.com');
        $user->setPassword($this->encoder->encodePassword($user, 'admin'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstName('Arnaud');
        $user->setLastName('THERET');
        $user->setAdress('39 rue de la fontaine saint martin');
        $user->setCp('60350');
        $user->setCity('Attichy');
        $user->setCountry('France');

        $manager->persist($user);


        $manager->flush();
    }
}