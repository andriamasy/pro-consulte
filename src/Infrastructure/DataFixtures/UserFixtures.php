<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // Création d'un utilisateur avec le rôle ADMIN
        $admin = new User();
        $admin->setFirstName('Mathieu');
        $admin->setLastName('Andriamasy');
        $admin->setEmail('admin@example.com');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'adminpass'));
        $admin->setRoles(['ROLE_ADMIN']);

        // Création d'un utilisateur avec le rôle USER
        $user = new User();
        $user->setFirstName('user');
        $user->setLastName('user');
        $user->setEmail('user@example.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'userpass'));
        $user->setRoles(['ROLE_USER']);

        $manager->persist($admin);
        $manager->persist($user);

        $manager->flush();
    }
}
