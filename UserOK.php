<?php

namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2,
    Zend\Stdlib\Hydrator;

/**
 * User
 * 
 * @ORM\Table(name="sonuser_user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * //@ORM\Entity(repositoryClass = "SONUser\Entity\UserRepository")
 */
class User
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
     * @ORM\Column(name="nome", type="string", length=255, nullable = false)
     */
    private $nome;

    /**
     * @var string
     * 
     * @ORM\Column(name="email", type="string", length=255, nullable = false)
     */
    private $email;

    /* &
     * @var string
     * 
     * @ORM\Column(name="password", type = "string", lenght= 255, nullable = false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=false)
     */
    private $activationKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;
//
//    /*
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    public function __construct(array $option = array())
    {
        /*
         * Atribui para todos os campos sets os valores de acordo o que está no array
         * inicio
         */
//        $hydrator = new Hydrator\ClassMethods();
//        $hydrator->hydrate($option, $this);

        (new Hydrator\ClassMethods)->hydrate($option, $this);

        /*
         * fim
         */

        $this->createdAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));

        $this->salt = base64_decode(Rand::getBytes(8, true));
        $this->activationKey = md5($this->email . $this->salt);
    }

    function getId()
    {
        return $this->id;
    }

    function getNome()
    {
        return $this->nome;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    function setId(Integer $id)
    {
        $this->id = $id;
        return $this;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password)
    {
        $this->password = $this->encryptPassword($password);
        return $this;
    }

    public function encryptPassword($password)
    {
        return base64_decode(Pbkdf2::calc('sha256', $password, $this->nome, 10000, strlen($password * 2)));
    }

    function getSalt()
    {
        return $this->salt;
    }

    function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    function getActivationKey()
    {
        return $this->activationKey;
    }

    function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;
        return $this;
    }

    function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
    }

    function getActive()
    {
        return $this->active;
    }

    function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    function getCreatedAt()
    {
        return $this->createdAt;
    }

    function setCreatedAt()
    {
        $this->createdAt = \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        return $this;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

}
