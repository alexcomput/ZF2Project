<?php

namespace SONUser\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SONUser\Entity\User;

class LoadUser implements FixtureInterface
{
 /*
  * @param ObjectManager $manager
  */
    public function load(ObjectManager $manager) 
    {
        $user = new User();
        $user->setNome("Alex Sandro")
                ->setEmail("alexcomput")
                ->setPassword(123456)
                ->setActive(true);
 
        $manager->persist($user);

        $manager->flush();
    }

}
