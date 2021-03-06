<?php

namespace Bidweb\BidwebBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProfileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProfileRepository extends EntityRepository {

    public function getUserProfiles($userid) {
        $qb = $this->createQueryBuilder('p')
                ->select('p')
                ->where('p.user = :id')
                ->addOrderBy('p.title', 'ASC')
                ->addOrderBy('p.created', 'DESC')
                ->setParameter('id', $userid);
        return $qb->getQuery()
                        ->getResult();
    }

    public function getActiveProfiles() {
        $qb = $this->createQueryBuilder('p')
                ->select('p')
                ->where('p.publish = true')
                ->addOrderBy('p.title', 'ASC')
                ->addOrderBy('p.created', 'DESC');

        return $qb->getQuery()
                        ->getResult();
    }

    public function getLastProfile($limit = 10) {
        $qb = $this->createQueryBuilder('p')
                ->select('p')
                ->where('p.publish = true')
                ->addOrderBy('p.created', 'DESC');
        
        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                        ->getResult();
    }
    
    public function searchProfile($text,$limit=null)
    {
        $qb = $this->createQueryBuilder('b')
                   ->select('b')
                   ->where('b.title LIKE :text')
                   ->orWhere('b.description LIKE :text')
                   
                   ->addOrderBy('b.created', 'DESC')
                ->setParameter('text', "%$text%");

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                  ->getResult();
    }

}
