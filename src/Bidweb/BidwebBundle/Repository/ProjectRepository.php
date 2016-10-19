<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Repository;

/**
 * Description of ProjectRepository
 *
 * @author walid
 */

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class ProjectRepository extends EntityRepository{
    
    public function getLatestProject($limit = null)
    {
        $qb = $this->createQueryBuilder('b')
                   ->select('b')
                   
                   ->addOrderBy('b.created', 'DESC');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                  ->getResult();
    }
    
    public function searchProject($text,$limit=null)
    {
        $qb = $this->createQueryBuilder('b')
                   ->select('b')
                   ->where('b.title LIKE :text')
                   ->orWhere('b.description LIKE :text')
                   ->orWhere('b.client.companyName LIKE :text')
                   ->addOrderBy('b.created', 'DESC')
                ->setParameter('text', "%$text%");

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                  ->getResult();
    }
    
    public function getFreelancerProject($user_id){
        $qb = $this->createQueryBuilder('b')
                ->select('b,c')
               ->innerJoin('b.team','c')
                ->where('c = :usert_id')
                ->setParameter('usert_id', $user_id);
      //  echo $qb->getQuery()->getSQL();die;
       
        return $qb->getQuery()
                        ->getResult();
    }
    
    
}
