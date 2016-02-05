<?php

namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Stdlib\Hydrator;
//GeneratedValue(strategy="IDENTITY")

/**
 * SonuserUser
 *
 * @ORM\Table(name="sonuser_user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class User
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=true)
     */
    private $activationKey;

    function __construct(array $options = array())
    {
        // Preencher automático os valores no objeto 
//        $hydrator = new Hydrator\ClassMethods;
//        $hydrator->hydrate($options, $this);

        (new Hydrator\ClassMethods)->hydrate($options, $this);

        $this->createdAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));

        $this->salt = base64_encode(Rand::getBytes(8, true));
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

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getSalt()
    {
        return $this->salt;
    }

    function getActive()
    {
        return $this->active;
    }

    function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    function getCreatedAt()
    {
        return $this->createdAt;
    }

    function getActivationKey()
    {
        return $this->activationKey;
    }

    function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    function setPassword($password)
    {
        $this->password = $this->encryptPassword($password);
        return $this;
    }

    function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        return $this;
    }

    function setCreatedAt()
    {
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        return $this;
    }

    function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;
        return $this;
    }

    public function encryptPassword($password)
    {
        return base64_encode(Pbkdf2::calc('sha256', $password, $this->salt, 10000, strlen($password * 2)));
    }

}
