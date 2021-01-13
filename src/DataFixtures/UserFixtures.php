<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $password_encoder)
    {
        $this->password_encoder = $password_encoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach($this->getUserData() as [$name,$last_name,$email,$password,$api_key,$roles])
        {
            $user = new User();
            $user->setName($name);
            $user->setLastName($last_name);
            $user->setEmail($email);
            $user->setPassword($this->password_encoder->encodePassword($user,$password));
            $user->setVimeoApiKey($api_key);
            $user->setRoles($roles);
            $manager->persist($user);
        }

        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            ['Alex', 'Petrescu', 'sh3rkan21@yahoo.com', 'parola111', 'hjfdgs6n', ['ROLE_ADMIN']],
            ['Alex', 'Petrescu2', 'sh3rkan21doi@yahoo.com', 'parola111', null, ['ROLE_ADMIN']],
            ['Alex', 'Popescu', 'sh3rkan2121@yahoo.com', 'parola111', null, ['ROLE_USER']],
        ];
    }

}
