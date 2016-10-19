<?php

// src/Adbck/BidwebBundle/Controller/PageController.php

namespace Bidweb\BidwebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//Custom class import
use Bidweb\BidwebBundle\Entity\ContactUs;
use Bidweb\BidwebBundle\Entity\ApplicationProject;
use Bidweb\BidwebBundle\Form\ContactUsType;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller {

    public function indexAction(Request $request) {
                
        $enquiry = new ContactUsType();
        $contact = new ContactUs();
        $form = $this->createForm($enquiry, $contact);
        $form->handleRequest($request);

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('BidwebBundle:Page:index2.html.twig', array(
                    'form' => $form->createView(),
            ));
        }else{
            $em = $this->getDoctrine()->getManager();
         
            $freelancers = $em->getRepository('UserBundle:Freelancer')->getLastProfile(10);
            
            $projects = $em->getRepository("BidwebBundle:Project")->getLatestProject(50);
            
            $countJob = count($em->getRepository('BidwebBundle:Project')
                            ->findAll());
            $countProfile = count($em->getRepository('UserBundle:Freelancer')
                            ->findAll());
            
            return $this->render('BidwebBundle:Page:index3.html.twig', array(
                        'form' => $form->createView(),
                        'countJob' =>$countJob,
                        'countProfile' =>$countProfile,
                        'profiles' =>$freelancers,
                        'projects' =>$projects,
            ));
        }
        
        
    }

    public function mypageAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $application = $em->getRepository("BidwebBundle:ApplicationJob")->findByUser($user->getId());
        $jobs = $em->getRepository("BidwebBundle:Job")->findByUser($user->getId());
        $databases = $em->getRepository("BidwebBundle:DatabaseSale")->findByUser($user->getId());
        $domains = $em->getRepository("BidwebBundle:DomainSale")->findByUser($user->getId());
        $seotools = $em->getRepository("BidwebBundle:SeoToolSale")->findByUser($user->getId());
        $websites = $em->getRepository("BidwebBundle:WebsiteSale")->findByUser($user->getId());
        $freelancers = $em->getRepository("BidwebBundle:Profile")->findByUser($user->getId());

        return $this->render('BidwebBundle:Page:mypage.html.twig', array(
                    'apps' => $application,
                    'jobs' => $jobs,
                    'databases' => $databases,
                    'domains' => $domains,
                    'seotools' => $seotools,
                    'websites' => $websites,
                    'freelancers' => $freelancers));
    }

    public function languageAction(Request $request, $_locale) {


        $this->get('session')->set('_locale', $_locale);
        $request->setLocale($_locale);

        return $this->redirect($this->generateUrl('bidweb_homepage'));
    }

    public function contactAction(Request $request) {
        $enquiry = new ContactUsType();
        $contact = new ContactUs();
        $form = $this->createForm($enquiry, $contact);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                        ->setSubject('Contact enquiry from Bidweb')
                        ->setFrom('bidweb.com@gmail.com')
                        ->setTo($this->container->getParameter('bidweb.emails.contact_email'))
                        ->setBody($this->renderView('BidwebBundle:Page:contactEmail.txt.twig', array('enquiry' => $contact)));
                $this->get('mailer')->send($message);
                $this->get('session')->getFlashBag()->set('bidweb-notice', 'Your contact enquiry was successfully sent. Thank you!');
                $em->persist($contact);
                $em->flush();
                return $this->redirect($this->generateUrl('bidweb_homepage'));
            }
        }

        return $this->render('BidwebBundle:Page:contact.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function createAction() {
        return $this->render('BidwebBundle:Page:choice.html.twig');
    }

    public function searchAction(Request $request) {

        $text = $request->request->get('text');
        $jobs=null;
        $freelancers=null;
        $websites=null;
        $domains=null;
        $databses=null;
        $seotools=null;
        $em = $this->getDoctrine()->getManager();
        
        if($request->request->get('jobCb')){
            $jobs = $em->getRepository("BidwebBundle:Job")->searchJob($text, 50);
        }
      
        if($request->request->get('freelancerCb')){
            $freelancers = $em->getRepository("BidwebBundle:Profile")->searchProfile($text, 50);
        }
        
        if($request->request->get('websiteCb')){
            $websites = $em->getRepository("BidwebBundle:WebsiteSale")->searchWebsite($text, 50);
        }
        
        if($request->request->get('domainCb')){
            $domains = $em->getRepository("BidwebBundle:DomainSale")->searchDomain($text, 50);
        }
        
        if($request->request->get('databaseCb')){
            $databses = $em->getRepository("BidwebBundle:DatabaseSale")->searchDatabase($text, 50);
        }
        
        if($request->request->get('seotoolCb')){
            $seotools = $em->getRepository("BidwebBundle:SeoToolSale")->searchSeotool($text, 50);
        }
        
        if ($request->request->get('allCb')) {
            $jobs = $em->getRepository("BidwebBundle:Job")->searchJob($text, 50);
            $freelancers = $em->getRepository("BidwebBundle:Profile")->searchProfile($text, 50);
            $websites = $em->getRepository("BidwebBundle:WebsiteSale")->searchWebsite($text, 50);
            $domains = $em->getRepository("BidwebBundle:DomainSale")->searchDomain($text, 50);
            $databses = $em->getRepository("BidwebBundle:DatabaseSale")->searchDatabase($text, 50);
            $seotools = $em->getRepository("BidwebBundle:SeoToolSale")->searchSeotool($text, 50);
        }
       
        
        
        return $this->render('BidwebBundle:Page:search.html.twig', 
                array('freelancers' => $freelancers, 
                    'jobs' => $jobs,
                    'websites' => $websites,
                    'domains' => $domains,
                    'databases' => $databses,
                    'seotools' => $seotools
                ));
    }

    public function sidebarAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $id = $user->getId();
        
        $countWorker = count($em->getRepository('BidwebBundle:ApplicationProject')->
                getWorker($id,ApplicationProject::$ACCEPTED));
        
        $countJob = count($em->getRepository('BidwebBundle:Project')
                ->findByClient($id));
        $countApp = count($em->getRepository('BidwebBundle:ApplicationProject')
                            ->findByFreelancer($this->getUser()->getId()));       
        
        
//        
//        $countProfile = count($em->getRepository('BidwebBundle:Profile')
//                ->findByUser($id));
        
//        $countWeb = count($em->getRepository('BidwebBundle:WebsiteSale')
//                ->findByUser($id));
//        
//        $countDomain = count($em->getRepository('BidwebBundle:DomainSale')
//                ->findByUser($id));
//        
//        $countSeo = count($em->getRepository('BidwebBundle:SeoToolSale')
//                ->findByUser($id));
//        
//        $countDatabase = count($em->getRepository('BidwebBundle:DatabaseSale')
//                ->findByUser($id));
//        
//        $countApp = count($em->getRepository('BidwebBundle:ApplicationJob')
//                ->findByUser($id));

        return $this->render('BidwebBundle:Page:slide.right.html.twig',
                array('countJob' => $countJob, 
                    'countWorker' => $countWorker,
                    'countProfile'=>0,
//                    'countWeb' => $countWeb,
//                    'countDomain' => $countDomain,
//                    'countSeo' => $countSeo,
//                    'countDatabase' => $countDatabase,
                    'countApp' => $countApp,
                ));
    }

    public function msgnotificationAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $msgcount = null;
        if ($user) {
            $msgcount = $em->getRepository('BidwebBundle:Message')
                    ->getMessageAccount($user->getId());
        } else {
            
        }
        return $this->render('BidwebBundle:Page:msgnotification.html.twig', array('user' => $user, 'msgCount' => $msgcount));
    }
    
    public function helpAction() {
        
        return $this->render('BidwebBundle:Page:help.html.twig');
    }

}
