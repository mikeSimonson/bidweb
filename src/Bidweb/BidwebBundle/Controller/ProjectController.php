<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Controller;

/**
 * Description of ProjectController
 *
 * @author Walid
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bidweb\BidwebBundle\Entity\Project;
use Bidweb\BidwebBundle\Entity\ApplicationProject;
use Bidweb\BidwebBundle\Entity\Notification;
use Bidweb\BidwebBundle\Form\ProjectType;


class ProjectController extends Controller {

    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();
        $ads = $em->getRepository('BidwebBundle:Project')->find($id);
        if (!$ads) {
            throw $this->createNotFoundException('Unable to find project.');
        }
        $countWait = count($em->getRepository('BidwebBundle:ApplicationProject')->getApplicationProjectByStatus(ApplicationProject::$WAIT, $id));
        $countAccepted = count($em->getRepository('BidwebBundle:ApplicationProject')->getApplicationProjectByStatus(ApplicationProject::$ACCEPTED, $id));
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:Project:show.html.twig', array(
                        'job' => $ads, 'wait' => $countWait, '' => $countAccepted
            ));
        } else {
            if ($ads->getClient()->getId() == $this->getUser()->getId()) {
                return $this->redirect($this->generateUrl("bidweb_project_show_my",array('id'=>$ads->getId(),"slug"=>$ads->getSlug())));
            } else {
                return $this->render('BidwebBundle:Project:show2.html.twig', array(
                            'project' => $ads, 'wait' => $countWait, '' => $countAccepted
                ));
            }
        }
    }

    public function showmyAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:Project')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find project.');
        }
        $applicationJob = $em->getRepository('BidwebBundle:ApplicationProject')->getApplicationProjectByStatus(ApplicationProject::$WAIT, $id);
        $worker = $em->getRepository('BidwebBundle:ApplicationProject')->getApplicationProjectByStatus(ApplicationProject::$ACCEPTED, $id);
//        $comments = $em->getRepository('BidwebBundle:Comment')
//                   ->getCommentsForPost($ads->getId());
//        

        return $this->render('BidwebBundle:Project:showmyproject.html.twig', array(
                    'project' => $ads, 'applications' => $applicationJob, 'workers' => $worker
        ));
    }

    public function myworkerAction() {

        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $worker = $em->getRepository('BidwebBundle:ApplicationProject')->getWorker($id, ApplicationProject::$ACCEPTED, $id);
        return $this->render('BidwebBundle:Project:my.worker.html.twig', array(
                    'workers' => $worker
        ));
    }

    public function showAllAction() {

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            $em = $this->getDoctrine()->getManager();
            $ads = $em->getRepository('BidwebBundle:Project')->getLatestProject();
            return $this->render('BidwebBundle:Project:projects.html.twig', array(
                        'jobs' => $ads,
            ));
        } else {

            $em = $this->getDoctrine()->getManager();
            $ads = $em->getRepository('BidwebBundle:Project')->getLatestProject();
            return $this->render('BidwebBundle:Project:projects2.html.twig', array(
                        'jobs' => $ads,
            ));
        }
    }

    public function freelancerAction() {

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $em = $this->getDoctrine()->getManager();
            $profiles = $em->getRepository("BidwebBundle:Profile")->getActiveProfiles();
            return $this->render("BidwebBundle:Job:freelancer.html.twig", array('profiles' => $profiles));
        } else {
            $em = $this->getDoctrine()->getManager();
            $profiles = $em->getRepository("BidwebBundle:Profile")->getActiveProfiles();
            return $this->render("BidwebBundle:Job:freelancer2.html.twig", array('profiles' => $profiles));
        }
    }

    /**
     * Confirm add add entry
     */
    public function confirmaddAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:Project')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find Project.');
        }

        return $this->render('BidwebBundle:Project:confirmaddproject.html.twig', array(
                    'job' => $ads
        ));
    }

    /**
     * Create New Ads
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        //$request = $this->getRequest();
        $job = new Project();

        $form = $this->createForm(new ProjectType($em), $job);
        $form->handleRequest($request);
        if ($this->getRequest()->isMethod('POST')) {
            if ($form->isValid()) {
                $job->setClient($this->getUser());
                $job->setSlug($job->slugUrl($job->getTitle()));
                $em->persist($job);
                $em->flush();

                return $this->redirect($this->generateUrl('bidweb_project_confirm_add', array('id' => $job->getId(), 'slug' => $job->getSlug()))
                );
            }
        }

        return $this->render('BidwebBundle:Project:create.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $job = $em->getRepository("BidwebBundle:Project")->find($id);

        if (!$job) {
            throw $this->createNotFoundException('No Job with this id = ' . $id);
        }

        $form = $this->createForm(new ProjectType(), $job);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $job->setSlug($job->slugUrl($job->getTitle()));

                $em->flush();
                return $this->redirect($this->generateUrl('bidweb_project_confirm_edit', array('id' => $job->getId(), 'slug' => $job->getSlug()))
                );
            }
        }
        return $this->render('BidwebBundle:Project:edit.html.twig', array(
                    'form' => $form->createView(), 'job' => $job
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

   

    public function myprojectsAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository("BidwebBundle:Project")->findByClient($user->getId());

        return $this->render('BidwebBundle:Project:myproject.html.twig', array(
                    'jobs' => $jobs
        ));
    }

    
    public function finishAction(Request $request, $id) {
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
    
    
    public function finishWorkAction(Request $request,$user_id,$project){
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository("BidwebBundle:Project")->find($project);
        $freelancer = $em->getRepository("UserBundle:Freelancer")->find($user_id);
        $project->removeTeam($freelancer);
        
        $notif = new Notification();
        $notif->setUser($freelancer);
        $notif->setMessage('Your work with this project  ' . $project->getTitle() .
                'is finished . ');
        $notif->setRead(false);
        $notif->setCreated(new \DateTime());
        $t = $this->get('translator')->trans('application.job.finished');
        $notif->setSubject($t);

        $message = \Swift_Message::newInstance()
                ->setSubject('Work project finished')
                ->setFrom('bidweb.com@gmail.com')
                ->setTo($Apply->getJob()->getUser()->getEmail())
                ->setBody($this->renderView('BidwebBundle:Project:application.txt.twig', array('enquiry' => $Apply)));
        $this->get('mailer')->send($message);
        
        
        $em->flush();
        return $this->render('BidwebBundle:Project:myproject.html.twig', array(
                    'jobs' => $jobs
        ));
    }

}
