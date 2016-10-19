<?php
namespace Bidweb\BidwebBundle\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebsiteController
 *
 * @author HAMMAMI
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bidweb\BidwebBundle\Entity\WebsiteSale;
use Bidweb\BidwebBundle\Form\WebsiteSaleType;



class WebsiteController extends Controller {
    /**
     * Show a ads entry
     */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:WebsiteSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find website.');
        }
//        $comments = $em->getRepository('BidwebBundle:Comment')
//                ->getCommentsForPost($ads->getId());

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:WebsiteSale:show.html.twig', array(
                        'post' => $ads
            ));
        } else {

            return $this->render('BidwebBundle:WebsiteSale:show2.html.twig', array(
                        'post' => $ads
            ));
        }
        
       
    }

    public function websitesAction() {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:WebsiteSale')->getLatestWebsite();

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:WebsiteSale:posts.html.twig', array(
                    'websites' => $ads,
        ));
        } else {

            return $this->render('BidwebBundle:WebsiteSale:posts2.html.twig', array(
                    'websites' => $ads,
        ));
        }

        
    }

    /**
     * Confirm add add entry
     */
    public function confirmaddAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:WebsiteSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find website.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:WebsiteSale:confirmaddpost.html.twig', array(
                    'website' => $ads
        ));
    }

    /**
     * Create New Ads
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        //$request = $this->getRequest();
        $ads = new WebsiteSale();

        $form = $this->createForm(new WebsiteSaleType($em), $ads);
        $form->handleRequest($request);
        if ($this->getRequest()->isMethod('POST')) {
            if ($form->isValid()) {
                $ads->setUser($this->getUser());
                $ads->setSlug($ads->slugUrl($ads->getTitle()));
                $em->persist($ads);
                $em->flush();

                return $this->redirect($this->generateUrl('bidweb_website_confirm_add', array('id' => $ads->getId(), 'slug' => $ads->getSlug()))
                );
            }
        }

        return $this->render('BidwebBundle:WebsiteSale:create.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function editwebsiteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $website = $em->getRepository("BidwebBundle:WebsiteSale")->find($id);

        if (!$website) {
            throw $this->createNotFoundException('No website with this id = ' . $id);
        }
        
        $form = $this->createForm(new WebsiteSaleType(), $website);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $website->setSlug($website->slugUrl($website->getTitle()));
               
                $em->flush();
                return $this->redirect($this->generateUrl('bidweb_website_confirm_edit', array('id' => $website->getId(), 'slug' => $website->getSlug()))
                );
            }
        }
        return $this->render('BidwebBundle:WebsiteSale:edit.html.twig', array(
                    'form' => $form->createView(),'website'=>$website
        ));
    }
    
    /**
     * Confirm add add entry
     */
    public function confirmeditAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:WebsiteSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find website.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:WebsiteSale:confirmedit.html.twig', array(
                    'website' => $ads
        ));
    }

    public function innerwebsiteAction(){
        $user=  $this->getUser();
        $em=  $this->getDoctrine()->getManager();
        $websites=$em->getRepository("BidwebBundle:WebsiteSale")->findByUser($user->getId());
        return $this->render('BidwebBundle:WebsiteSale:innerpost.html.twig', array(
                    'posts' => $websites
        ));
    }
}
