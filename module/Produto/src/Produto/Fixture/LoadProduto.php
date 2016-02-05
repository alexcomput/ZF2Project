<?php

namespace Produto\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Produto\Entity\Produto;

/**
 * Description of LoadProduto
 *
 * @author Itop1
 */
class LoadProduto extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {
        $produto = new Produto();
        $produto->setDescricao("feijão")
                ->setId(30);
        $manager->persist($produto);
        $manager->flush();
    }

}
