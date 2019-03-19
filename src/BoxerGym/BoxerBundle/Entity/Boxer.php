<?php

namespace BoxerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="BoxerBundle\Repository\BoxerRepository")
 * @ORM\Table(name="boxers", uniqueConstraints={
    * @ORM\UniqueConstraint(name="boxers_id_uindex", columns={"id"}), 
    * @ORM\UniqueConstraint(name="boxers_email_uindex", columns={"email"})
 * })
*/
class Boxer 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
    */
    private $id;

    /**
     * @ORM\Column(type="string")
    */
    private $name;

    /**
     * @ORM\Column(type="string")
    */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="GymBundle\Entity\Gym", inversedBy="boxers", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="gym", referencedColumnName="id")
    */
    private $gym;

    
    function __construct() {}

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of gym
     */ 
    public function getGym()
    {
        return $this->gym;
    }

    /**
     * Set the value of gym
     *
     * @return  self
     */ 
    public function setGym($gym)
    {
        $this->gym = $gym;

        return $this;
    }
}