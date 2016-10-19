<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfileController
 *
 * @author HAMMAMI
 */

namespace Bidweb\BidwebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bidweb\BidwebBundle\Entity\Profile;
use Bidweb\BidwebBundle\Form\ProfileType;

class ProfileController extends Controller{
    
    public function showAction(){
       $em = $this->getDoctrine()->getManager();
        
       $user = $this->getUser();
       
       $profiles = $em->getRepository("BidwebBundle:Profile")->getUserProfiles($user->getId());
       if(count($profiles)==0){
           $profile = new Profile($this->getUser());
           $profile->setTitle("");
           $profile->setDescription("");
           $profile->setSlug($profile->slugUrl($this->getUser()));
           $em->persist($profile);
           $em->flush();
           $profiles = $em->getRepository("BidwebBundle:Profile")->getUserProfiles($user->getId());
       }
       
       return $this->render('BidwebBundle:Profile:show.html.twig',  array('profiles'=>$profiles));
    }
    
    
    public function newprofileAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profile = new Profile($user);
        $form = $this->createForm(new ProfileType(),$profile);
        $form->handleRequest($request);
        if($request->getMethod()=='POST'){
            if($form->isValid()){
                $profile->setSlug($profile->slugUrl($profile->getTitle()));
                //$profile->setCategory($profile->getSubcategory()->getCategory());
                $em->persist($profile);
                $em->flush();
                return $this->redirect($this->generateUrl('show_profiles'));

            }
        }
        
        
        return $this->render("BidwebBundle:Profile:create.html.twig",array('form'=>$form->createView(),'errors'=>array()));
    }
    
    
    public function publishprofileAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository("BidwebBundle:Profile")->find($id);
        $profile->setPublish(true);
        $em->persist($profile);
        $em->flush();
     
        return $this->redirect($this->generateUrl('show_profiles'));
      
    }
    
    public function hideprofileAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository("BidwebBundle:Profile")->find($id);
        $profile->setPublish(false);
        $em->persist($profile);
        $em->flush();
     
        return $this->redirect($this->generateUrl('show_profiles'));
      
    }
    
    public function deleteprofileAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository("BidwebBundle:Profile")->find($id);
        $profile->setPublish(true);
        $em->remove($profile);
        $em->flush();
     
        return $this->redirect($this->generateUrl('show_profiles'));
      
    }
    public function editprofileAction(Request $request,$id){
        
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository("BidwebBundle:Profile")->find($id);
//        $profile->fileImage = fopen($profile->getAbsoluteImage(),'w');
      
        $profile->setUser($this->getUser());
        $form = $this->createForm(new ProfileType(), $profile);
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                //$profile->setCategory($profile->getSubcategory()->getCategory());
               // $em->persist($profile);
                $profile->setUpdated(new \DateTime());
                $em->flush();
                return $this->redirect($this->generateUrl('show_profiles'));
            }
        }


        return $this->render("BidwebBundle:Profile:editprofile.html.twig",array('form'=>$form->createView(),'errors'=>array()
            ,'profile'=>$profile));
        
    }
    
    
    public function detailsAction($id){
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository("BidwebBundle:Profile")->find($id);
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

           return $this->render("BidwebBundle:Profile:details.html.twig",array('prof'=>$profile));
        } else {

           return $this->render("BidwebBundle:Profile:details2.html.twig",array('prof'=>$profile));
        }
       
    }
    
}
