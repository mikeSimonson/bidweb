<?php

namespace Bidweb\BidwebBundle\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JobController
 *
 * @author HAMMAMI
 */



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bidweb\BidwebBundle\Entity\Job;
use Bidweb\BidwebBundle\Entity\ApplicationJob;
use Bidweb\BidwebBundle\Entity\Notification;

use Bidweb\BidwebBundle\Form\JobType;
use Bidweb\BidwebBundle\Form\ApplicationJobType;

class JobController  extends Controller{
    
    public function showAction($id,$slug)
    {
        $em = $this->getDoctrine()->getManager();
        $ads = $em->getRepository('BidwebBundle:Job')->find($id);
        if (!$ads) {
            throw $this->createNotFoundException('Unable to find post.');
        }
       
        
        
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:Job:show.html.twig', array(
                        'job' => $ads
            ));
        } else {

            return $this->render('BidwebBundle:Job:show2.html.twig', array(
                        'job' => $ads
            ));
        }
    }
    
    public function showmyAction($id,$slug)
    {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:Job')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find post.');
        }
        $applicationJob = $em->getRepository('BidwebBundle:ApplicationJob')->getApplicationJobByStatus(ApplicationJob::$WAIT,$id);
        $worker = $em->getRepository('BidwebBundle:ApplicationJob')->getApplicationJobByStatus(ApplicationJob::$ACCEPTED,$id);
//        $comments = $em->getRepository('BidwebBundle:Comment')
//                   ->getCommentsForPost($ads->getId());
//        
        
        return $this->render('BidwebBundle:Job:showmyjob.html.twig', array(
            'job'      => $ads,'applications' => $applicationJob,'workers'=>$worker
        ));
    }
    
    public function myworkerAction(){
        
        $id=$this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $worker = $em->getRepository('BidwebBundle:ApplicationJob')->getWorker($id,ApplicationJob::$ACCEPTED,$id);
        return $this->render('BidwebBundle:Job:my.worker.html.twig', array(
            'workers'      => $worker
        ));
        
    }

    public function jobsAction(){
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
           
            $em = $this->getDoctrine()->getManager();
            $ads = $em->getRepository('BidwebBundle:Job')->getLatestJob();
            return $this->render('BidwebBundle:Job:jobs.html.twig', array(
                        'jobs' => $ads,
            ));
        }else{
            
            $em = $this->getDoctrine()->getManager();
            $ads = $em->getRepository('BidwebBundle:Job')->getLatestJob();
            return $this->render('BidwebBundle:Job:jobs2.html.twig', array(
                        'jobs' => $ads,
            ));
        }
    }
    
   
    public function freelancerAction(){
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $em = $this->getDoctrine()->getManager();
            $profiles = $em->getRepository("BidwebBundle:Profile")->getActiveProfiles();
            return $this->render("BidwebBundle:Job:freelancer.html.twig",array('profiles'=>$profiles));
        }else{
            $em = $this->getDoctrine()->getManager();
            $profiles = $em->getRepository("BidwebBundle:Profile")->getActiveProfiles();
            return $this->render("BidwebBundle:Job:freelancer2.html.twig",array('profiles'=>$profiles));
        }
        
    }
    
    
     /**
     * Confirm add add entry
     */
    public function confirmaddAction($id,$slug)
    {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:Job')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find Job.');
        }
     
        return $this->render('BidwebBundle:Job:confirmaddjob.html.twig', array(
            'job'      => $ads
        ));
    }
    /**
     * Create New Ads
     */
    public function createAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        //$request = $this->getRequest();
        $job = new Job();
        
        $form    = $this->createForm(new JobType($em), $job);
        $form->handleRequest($request);
         if ($this->getRequest()->isMethod('POST')) {
             if ($form->isValid()) {
                $job->setUser($this->getUser());
                $job->setSlug($job->slugUrl($job->getTitle()));
                $em->persist($job);
                $em->flush();
                
                return $this->redirect($this->generateUrl('bidweb_job_confirm_add',
                        array('id' => $job->getId(),'slug' => $job->getSlug()))
                        );
            }
         }
    
        return $this->render('BidwebBundle:Job:create.html.twig', array(
            
            'form'    => $form->createView()
        ));
    }
    
    public function editjobAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $job = $em->getRepository("BidwebBundle:Job")->find($id);

        if (!$job) {
            throw $this->createNotFoundException('No Job with this id = ' . $id);
        }
        
        $form = $this->createForm(new JobType(), $job);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $job->setSlug($job->slugUrl($job->getTitle()));
               
                $em->flush();
                return $this->redirect($this->generateUrl('bidweb_job_confirm_edit', array('id' => $job->getId(), 'slug' => $job->getSlug()))
                );
            }
        }
        return $this->render('BidwebBundle:Job:edit.html.twig', array(
                    'form' => $form->createView(),'job'=>$job
        ));
    }
    
    /**
     * Confirm add add entry
     */
    public function confirmeditAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:Job')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find Job.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:Job:confirmeditjob.html.twig', array(
                    'job' => $ads
        ));
    }
    
    public function applyAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profile = $em->getRepository("BidwebBundle:Profile")->findByUser($user->getId());
        if(!$profile){
            return $this->render('BidwebBundle:Job:error.html.twig');
        }
        
        $Apply = new ApplicationJob();
        $job = $em->getRepository("BidwebBundle:Job")->find($id);
        $Apply->setJob($job);
        $Apply->setUser($this->getUser());
        $Apply->setStatus(0);
        $form    = $this->createForm(new ApplicationJobType(), $Apply);
        $form->handleRequest($request);
         if ($this->getRequest()->isMethod('POST')) {
             if ($form->isValid()) {
                 
               $t = $this->get('translator')->trans('new.application.job');
               $notif = new Notification();
               $notif->setUser($job->getUser());
               $notif->setMessage('New job application for your job  '.$job->getTitle().
                       '. For more details go to '.$this->generateUrl('bidweb_myapplication'));
               $notif->setRead(false);
               $notif->setCreated(new \DateTime());
               $notif->setSubject($t);
               
               $message = \Swift_Message::newInstance()
                        ->setSubject('Application job')
                        ->setFrom('bidweb.com@gmail.com')
                        ->setTo($Apply->getJob()->getUser()->getEmail())
                        ->setBody($this->renderView('BidwebBundle:Job:application.txt.twig', array('enquiry' => $Apply)));
                $this->get('mailer')->send($message);
                $em->persist($Apply);
                $em->persist($notif);
                $em->flush();
                
                return $this->redirect($this->generateUrl('bidweb_apply_confirm'));
            }
         }
    
        return $this->render('BidwebBundle:Job:apply.html.twig', array(
            
            'form'    => $form->createView(),'job'=>$job
        ));
    }
    
    public function applyconfirmAction()
    {
        
        return $this->render('BidwebBundle:Job:applyconfirm.html.twig');
    }

    public function myjobAction(){
        $user=  $this->getUser();
        $em=  $this->getDoctrine()->getManager();
        $jobs=$em->getRepository("BidwebBundle:Job")->findByUser($user->getId());
       
        return $this->render('BidwebBundle:Job:myjob.html.twig', array(
                    'jobs' => $jobs
        ));
    }
    
    public function myapplicationAction(){
        $user=  $this->getUser();
        $em=  $this->getDoctrine()->getManager();
        $jobs=$em->getRepository("BidwebBundle:ApplicationJob")->findByUser($user->getId());
        return $this->render('BidwebBundle:Job:myapplication.html.twig', array(
                    'jobs' => $jobs
        ));
    }
    

    public function acceptAction($id){
        $em = $this->getDoctrine()->getManager();
        $application = $em->getRepository('BidwebBundle:ApplicationJob')->find($id);
        $application->setStatus(ApplicationJob::$ACCEPTED);
        //Send Notification to User 
        $t = $this->get('translator')->trans('application.job.accepted');

        $notif = new Notification();
        $notif->setUser($application->getUser());
        $notif->setMessage($t .' : ' . $application->getJob()->getTitle() .
                '. For more details go to ' . $this->generateUrl('bidweb_myapplication'));
        $notif->setRead(false);
        $notif->setCreated(new \DateTime());
        $notif->setSubject($t);
        
        $message = \Swift_Message::newInstance()
                ->setSubject('Application job accepted')
                ->setFrom('bidweb.com@gmail.com')
                ->setTo($application->getUser()->getEmail())
                ->setBody($this->renderView('BidwebBundle:Job:application.accepted.txt.twig', array('enquiry' => $application)));
        $this->get('mailer')->send($message);
        $em->persist($notif);        
        $em->flush();
        return $this->redirect($this->generateUrl('bidweb_job_showmy',array('id'=>$application->getJob()->getId(),'slug'=>$application->getJob()->getSlug())));
        
    }
    
    public function declineAction($id){
        $em = $this->getDoctrine()->getManager();
        $application = $em->getRepository('BidwebBundle:ApplicationJob')->find($id);
        $application->setStatus(ApplicationJob::$DECLINED);
        //Send Notification to User 
        $t = $this->get('translator')->trans('application.job.declined');

        $notif = new Notification();
        $notif->setUser($application->getUser());
        $notif->setMessage($t .' : ' . $application->getJob()->getTitle() .
                '. For more details go to ' . $this->generateUrl('bidweb_myapplication'));
        $notif->setRead(false);
        $notif->setCreated(new \DateTime());
        $notif->setSubject($t);
        
        $message = \Swift_Message::newInstance()
                ->setSubject('Application job declined')
                ->setFrom('bidweb.com@gmail.com')
                ->setTo($application->getUser()->getEmail())
                ->setBody($this->renderView('BidwebBundle:Job:application.accepted.txt.twig', array('enquiry' => $application)));
        $this->get('mailer')->send($message);
        
        $em->persist($notif);        
        $em->flush();
        return $this->redirect($this->generateUrl('bidweb_job_showmy',array('id'=>$application->getJob()->getId(),'slug'=>$application->getJob()->getSlug())));
        
    }
    
    public function steptwoAction(){
        
        
       return $this->render("BidwebBundle:Job:steptwo.html.twig",array("Msg"=>"This will be done after"));
    }
    
    public function finishAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $Apply = $em->getRepository("BidwebBundle:ApplicationJob")->find($id);
       
        $Apply->setStatus(ApplicationJob::$FINISHED);

        $t = $this->get('translator')->trans('application.job.finished');
        $notif = new Notification();
        $notif->setUser($Apply->getUser());
        $notif->setMessage('your job application is finished  ' . $Apply->getJob()->getTitle() .
                '. For more details go to ' . $this->generateUrl('bidweb_myapplication'));
        $notif->setRead(false);
        $notif->setCreated(new \DateTime());
        $notif->setSubject($t);

        $message = \Swift_Message::newInstance()
                ->setSubject('Application job finished')
                ->setFrom('bidweb.com@gmail.com')
                ->setTo($Apply->getJob()->getUser()->getEmail())
                ->setBody($this->renderView('BidwebBundle:Job:application.txt.twig', array('enquiry' => $Apply)));
        $this->get('mailer')->send($message);
       // $em->persist($Apply);
        $em->persist($notif);
        $em->flush();

       
       
       // $worker = $em->getRepository('BidwebBundle:ApplicationJob')->getWorker($id,ApplicationJob::$ACCEPTED,$id);
        return $this->redirect($this->generateUrl('bidweb_my_worker'));
        
    }
}
