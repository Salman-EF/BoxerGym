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
    private $adress;

    /**
     * @ORM\OneToMany(targetEntity="BoxerBundle\Entity\Boxer", mappedBy="gym")
     */
    private $boxers;

    /**
     * Contructor
    */
    function __construct($name,$adress)
    {
        $this->name = $name;
        $this->adress = $adress;
    }


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
     * Get the value of adress
     */ 
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set the value of adress
     *
     * @return  self
     */ 
    public function setAdress($adress)
    {
        $this->adress = $adress;

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