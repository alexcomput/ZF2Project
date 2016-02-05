<?php

namespace SONUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;

use SONUser\Entity\User;

# As Fixtures são utilizadas para realizar uma carga inicial no banco de dados. 
# Geralmente utilizadas para realizar testes e não ter a necessidade de ficar
# sempre populando as informações no banco de dados.

class LoadUser extends AbstractFixture {

    public function load(ObjectManager $manager) {
        
        $user = new User();
        $user->setNome("Vinícius")
            ->setEmail("viniciusfesil@gmail.com")
            ->setPassword(123456)
            ->setActive(true);
        $manager->persist($user);
        
        $user1 = new \SONUser\Entity\User();
        $user1->setNome("Admin")
            ->setEmail("admin@admin.com")
            ->setPassword(123456)
            ->setActive(TRUE);
        $manager->persist($user1);
        $manager->flush();
        
    }

}