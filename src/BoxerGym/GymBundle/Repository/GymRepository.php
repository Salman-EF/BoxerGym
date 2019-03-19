<?php

namespace GymBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GymRepository extends EntityRepository 
{
    
    public function findByName($name) {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT g FROM GymBundle:Gym g WHERE g.name = :name'
            )
            ->setParameter('name',$name)
            ->getOneOrNullResult();
    }

    public function createGym($gym) {
        $em = $this->getEntityManager();
        $em->persist($gym);
        $em->flush();

        return $gym->getId();
    }

    public function deleteGym($gym) {
        $em = $this->getEntityManager();
        $em->remove($gym);
        $em->flush();

        return $gym;
    }

    public function updateGym($gym) {
        $em = $this->getEntityManager();
        $em->persist($gym);
        $em->flush();

        return $gym;
    }
}