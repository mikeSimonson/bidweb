<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Controller;

/**
 * Description of ClientController
 *
 * @author Walid
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bidweb\BidwebBundle\Entity\ApplicationProject;
class ClientController extends Controller{
   
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('Bidweb\UserBundle\Entity\Client');
    }
    
    public function clientApplicationAction(){
        $em = $this->getDoctrine()->getManager();
        $applicationsWait  = $em->getRepository("BidwebBundle:ApplicationProject")
                ->getApplicationByClient($this->getUser()->getId(),ApplicationProject::$WAIT);
        $applicationsAccepted  = $em->getRepository("BidwebBundle:ApplicationProject")
                ->getApplicationByClient($this->getUser()->getId(),ApplicationProject::$ACCEPTED);
        
        $applicationsDeclined  = $em->getRepository("BidwebBundle:ApplicationProject")
                ->getApplicationByClient($this->getUser()->getId(),ApplicationProject::$DECLINED);
        
        return $this->render("BidwebBundle:Client:application.html.twig",
                array("wait"=>$applicationsWait,"accepted"=>$applicationsAccepted,"declined"=>$applicationsDeclined));
        
    }
    
    public function applicationDetailAcction($id){
        $em = $this->getDoctrine()->getManager();
        $application  = $em->getRepository("BidwebBundle:ApplicationProject")->find($id);
        return $this->render("BidwebBundle:Client:application.detail.html.twig",
                array("application"=>$application));
    }
    
    
    public function myProjectAction(){
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository("BidwebBundle:Project")->findByClient($this->getUser()->getId());
        return $this->render("BidwebBundle:Client:myproject.html.twig",
                array("projects"=>$projects));
    }
    
    public function projectDetailAction($id,$slug){
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository("BidwebBundle:Project")->find($id);
        $team = $project->getTeam();
        return $this->render("BidwebBundle:Client:myproject.html.twig",
                array("projects"=>$project,"team"=>$team));
    }
}
