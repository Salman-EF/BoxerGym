<?php

namespace BoxerBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BoxerRepository extends EntityRepository
{
    
    public function findByEmail($email) {
        $em = $this->getEntityManager();
        $qb = $this->_em->createQueryBuilder();
        $boxerByName = $qb->select('b')
            ->from('BoxerBundle:Boxer', 'b')
            ->where('b.email = :email')
            ->setParameter('email',$email);
        $boxerByName = $qb->getQuery()->getResult();
        return $boxerByName;
    }

    public function findByName($name) {
        $em = $this->getEntityManager();
        $qb = $this->_em->createQueryBuilder();
        $boxerByName = $qb->select('b')
            ->from('BoxerBundle:Boxer', 'b')
            ->where('b.name = :name')
            ->setParameter('name',$name);
        $boxerByName = $qb->getQuery()->getResult();
        return $boxerByName;
    }

    public function findAllOrderByName() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT b FROM BoxerBundle:Boxer b ORDER BY b.name'
            )
            ->getResult();
    }

    public function findLastFive() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT b FROM BoxerBundle:Boxer b ORDER BY b.id DESC'
            )
            ->setMaxResults(5)
            ->getResult();
    }

    public function createBoxer($boxer) {
        $em = $this->getEntityManager();
        $em->persist($boxer);
        $em->flush();

        return $boxer;
    }

    public function deleteBoxer($boxer) {
        $em = $this->getEntityManager();
        $em->remove($boxer);
        $em->flush();

        return $boxer;
    }

    public function updateBoxer($boxer) {
        $em = $this->getEntityManager();
        $em->persist($boxer);
        $em->flush();

        return $boxer;
    }
}
