<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Controller;

/**
 * Description of FreelancerControler
 *
 * @author Walid
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bidweb\BidwebBundle\Entity\Profile;

class FreelancerController extends Controller{
    
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('Bidweb\UserBundle\Entity\Freelancer');
    }
    
    public function myProjectAction(){
        $em=  $this->getDoctrine()->getManager();
        $projects = $em->getRepository("BidwebBundle:Project")->getFreelancerProject($this->getUser()->getId());
        
        return $this->render("BidwebBundle:Freelancer:myproject.html.twig",array("projects"=>$projects));
    }
    
    public function projectDetailAction($id){
        
        $em=  $this->getDoctrine()->getManager();
        $project = $em->getRepository("BidwebBundle:Project")->find($id);
        $team = $project->getTeam();
        return $this->render("BidwebBundle:Freelancer:project.detail.html.twig",
                array("project"=>$project,"team"=>$team,"id"=>  $this->getUser()->getId()));
        
    }
    
    public function profileAction($id){
        $em=  $this->getDoctrine()->getManager();
        $profile = $em->getRepository("BidwebBundle:Profile")->findOneByUser($id);
        
        if(count($profile)==0){
           
           $user = $em->getRepository("UserBundle:Freelancer")->find($id);
           $profile = new Profile($user);
           $profile->setTitle("");
           $profile->setDescription("");
           $profile->setSlug($profile->slugUrl($this->getUser()));
           $em->persist($profile);
           $em->flush();
        }
        
       
        
        $projects = $em->getRepository("BidwebBundle:Project")->getFreelancerProject($id);
       
       // $feebacks = $em->getRepository("BidwebBundle:Feedback")->findByUser($id);
       
        return $this->render("BidwebBundle:Freelancer:profile.html.twig",
                array("profile"=>$profile,"projects"=>$projects));
        
    }
}
