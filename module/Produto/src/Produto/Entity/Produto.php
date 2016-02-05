<?php

namespace Produto\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Produto
 *  
 * @ORM\Table(name="produto")
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks
 */
class Produto
{

    /**
     * @var integer
     * 
     * @ORM\Id
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     * 
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="descricao", type="string", length=255, nullable = false)
     */
    private $descricao;

    function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

}
