<?php

namespace Produto\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Produto extends AbstractService
{

    protected $view;

    public function __construct(EntityManager $em, $view)
    {
        parent::__construct($em);

        $this->entity = 'Produto\Entity\Produto';
        //$this->transport = $transport;
        $this->view = $view;
    }

    public function insert(array $data)
    {
        $entity = parent::insert($data);
        return $entity;
    }

}
