<?php

namespace BoxerBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BoxerRepository extends EntityRepository
{
    
    public function findByEmail($email) {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT b FROM BoxerBundle:Boxer b WHERE b.email = :email'
            )
            ->setParameter('email',$email)
            ->getOneOrNullResult();
    }

    public function findAllOrderByName() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT b FROM BoxerBundle:Boxer b ORDER BY b.name'
            )
            ->getResult();
    }

    public function createBoxer($boxer) {
        $em = $this->getEntityManager();
        $em->persist($boxer);
        $em->flush();

        return $boxer->getId();
    }

    public function deleteBoxer($boxer) {
        $em = $this->getEntityManager();
        $em->remove($boxer);
        $em->flush();
    }
}
