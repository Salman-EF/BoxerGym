<?php

namespace GymBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="GymBundle\Repository\GymRepository")
 * @ORM\Table(name="gyms", uniqueConstraints={
    * @ORM\UniqueConstraint(name="gyms_id_uindex", columns={"id"})
 * })
*/
class Gym 
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
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="BoxerBundle\Entity\Boxer", mappedBy="gym", cascade={"persist","remove"})
     */
    private $boxers;

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
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of boxers
     */ 
    public function getBoxers()
    {
        return $this->boxers;
    }

    /**
     * Set the value of boxers
     *
     * @return  self
     */ 
    public function setBoxers($boxers)
    {
        $this->boxers = $boxers;

        return $this;
    }
}