<?php
namespace Bidweb\UserBundle\Repository;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FreelancerRepository
 *
 * @author walid
 */

use Doctrine\ORM\EntityRepository;

class FreelancerRepository extends EntityRepository {
     public function getLastProfile($limit = 10) {
        $qb = $this->createQueryBuilder('p')
                ->select('p')
                ->addOrderBy('p.id', 'DESC');
        
        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                        ->getResult();
    }
}
