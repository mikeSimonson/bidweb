<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Repository;

/**
 * Description of ApplicationProjectRepository
 *
 * @author walid
 */

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;


class ApplicationProjectRepository extends EntityRepository{
    
    public function getApplicationProjectByStatus($status, $id_project, $limit = null) {
        $qb = $this->createQueryBuilder('b')
                ->select('b')
                ->where('b.status = :st')
                ->andWhere('b.project = :jobid')
                ->addOrderBy('b.created', 'DESC')
                ->setParameter('jobid', $id_project)
                ->setParameter('st', $status);

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                        ->getResult();
    }

    public function getWorker($id_user, $status, $limit = null) {
       
        $qb = $this->createQueryBuilder('b')
                ->select('b, j')
                ->join('b.project', 'j', Join::WITH, 'j.client = :usert_id')
                ->where('b.status = :st')
                ->setParameter('usert_id', $id_user)
                ->setParameter('st', $status);
      //  echo $qb->getQuery()->getSQL();die;
        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                        ->getResult();
    }
    
    public function getApplicationByClient($client_id,$status, $limit = null){
        $qb = $this->createQueryBuilder('b')
                ->select('b')
                ->innerJoin("b.project", "p")
                ->where('b.status = :st')
                ->andWhere('p.client = :clientid')
                ->addOrderBy('b.created', 'DESC')
                ->setParameter('clientid', $client_id)
                ->setParameter('st', $status);

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                        ->getResult();
    }
    
    
}
