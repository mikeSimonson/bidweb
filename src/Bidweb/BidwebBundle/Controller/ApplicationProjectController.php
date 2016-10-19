<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Controller;

/**
 * Description of ApplicationProjectController
 *
 * @author Walid
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Bidweb\BidwebBundle\Entity\ApplicationProject;
use Bidweb\BidwebBundle\Entity\Notification;

use Bidweb\BidwebBundle\Form\ApplicationProjectType;


class ApplicationProjectController extends Controller{
    //put your code here
    
    public function applyAction(Request $request,$id){
        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();


        $Apply = new ApplicationProject();
        $job = $em->getRepository("BidwebBundle:Project")->find($id);
        $Apply->setProject($job);
        $Apply->setFreelancer($this->getUser());
        $Apply->setStatus(0);
        $form = $this->createForm(new ApplicationProjectType(), $Apply);
        $form->handleRequest($request);
        if ($this->getRequest()->isMethod('POST')) {
            if ($form->isValid()) {

                $t = $this->get('translator')->trans('new.application.job');
                $notif = new Notification();
                $notif->setUser($job->getClient());
                $notif->setMessage('New project application for your project  ' . $job->getTitle() .
                        '.');
                $notif->setRead(false);
                $notif->setCreated(new \DateTime());
                $notif->setUrl($this->generateUrl('bidweb_project_show',array('id'=>$job->getId()
                        ,'slug'=>$job->getSlug())));
                $notif->setSubject($t);

                $message = \Swift_Message::newInstance()
                        ->setSubject('Application project')
                        ->setFrom('bidweb.com@gmail.com')
                        ->setTo($Apply->getProject()->getClient()->getEmail())
                        ->setBody($this->renderView('BidwebBundle:Project:application.txt.twig', 
                                array('enquiry' => $Apply,'url'=> 'http://bidweb.dev:8085' . $this->generateUrl('bidweb_project_show',array('id'=>$job->getId()
                        ,'slug'=>$job->getSlug())) )));
                $this->get('mailer')->send($message);
                $em->persist($Apply);
                $em->persist($notif);
                $em->flush();

                return $this->redirect($this->generateUrl('bidweb_apply_confirm'));
            }
        }

        return $this->render('BidwebBundle:Project:apply.html.twig', array(
                    'form' => $form->createView(), 'job' => $job
        ));
    }
    
    public function acceptAction(Request $request,$app){
        $em = $this->getDoctrine()->getManager();
        $application = $em->getRepository('BidwebBundle:ApplicationProject')->find($app);
        $application->setStatus(ApplicationProject::$ACCEPTED);
        $application->getProject()->addTeam($application->getFreelancer());
        
        $t = $this->get('translator')->trans('application.job.accepted');

        $notif = new Notification();
        $notif->setUser($application->getFreelancer());
        $notif->setMessage($t . ' : ' . $application->getProject()->getTitle() .
                '.' );
        $notif->setUrl($this->generateUrl('bidweb_project_show',array('id'=>$application->getProject()->getId()
                        ,'slug'=>$application->getProject()->getSlug())));
        $notif->setRead(false);
        $notif->setCreated(new \DateTime());
        $notif->setSubject($t);

        $message = \Swift_Message::newInstance()
                ->setContentType("text/html")
                ->setSubject('Application job accepted')
                ->setFrom('bidweb.com@gmail.com')
                ->setTo($application->getFreelancer()->getEmail())
                ->setBody($this->renderView('BidwebBundle:Project:application.accepted.txt.twig', array('enquiry' => $application)));
        $this->get('mailer')->send($message);
        $em->persist($notif);
        $em->flush();
        return $this->redirect($this->generateUrl('bidweb_project_show_my', 
                array('id' => $application->getProject()->getId(), 'slug' => $application->getProject()->getSlug())));
    }
    
    public function declineAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $application = $em->getRepository('BidwebBundle:ApplicationProject')->find($id);
        $application->setStatus(ApplicationJob::$DECLINED);
        //Send Notification to User 
        $t = $this->get('translator')->trans('application.project.declined');

        $notif = new Notification();
        $notif->setUser($application->getFreelancer());
        $notif->setMessage($t . ' : ' . $application->getProject()->getTitle() .
                '. For more details go to ' . $this->generateUrl('bidweb_myapplication'));
        $notif->setUrl($this->generateUrl('bidweb_project_show',array('id'=>$job->getId()
                        ,'slug'=>$job->getSlug())));
        $notif->setRead(false);
        $notif->setCreated(new \DateTime());
        $notif->setSubject($t);

        $message = \Swift_Message::newInstance()
                ->setSubject('Application project declined')
                ->setFrom('bidweb.com@gmail.com')
                ->setTo($application->getFreelancer()->getEmail())
                ->setBody($this->renderView('BidwebBundle:Project:application.accepted.txt.twig', array('enquiry' => $application)));
        $this->get('mailer')->send($message);

        $em->persist($notif);
        $em->flush();
        return $this->redirect($this->generateUrl('bidweb_project_showmy', array('id' => $application->getProject()->getId(), 'slug' => $application->getProject()->getSlug())));
    }

    public function applyconfirmAction() {

        return $this->render('BidwebBundle:Project:applyconfirm.html.twig');
    }
    
     public function myapplicationAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository("BidwebBundle:ApplicationProject")->findByFreelancer($user->getId());
        return $this->render('BidwebBundle:Project:myapplication.html.twig', array(
                    'jobs' => $jobs
        ));
    }
    
    public function clientappAction(){
        $em = $this->getDoctrine()->getManager();
        $applications=$em->getRepository("BidwebBundle:ApplicationProject")->gettApplicationByClient($this->getUser()->getId());
        return $this->render('BidwebBundle:Client:application.html.twig');
    }
}
