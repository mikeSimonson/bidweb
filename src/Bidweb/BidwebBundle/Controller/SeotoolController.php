<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bidweb\BidwebBundle\Entity\SeoToolSale;
use Bidweb\BidwebBundle\Form\SeoToolSaleType;

/**
 * Description of SeotoolController
 *
 * @author HAMMAMI
 */
class SeotoolController extends Controller {
    
    /**
     * Show a ads entry
     */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:SeoToolSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find Database.');
        }
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:SeoToolSale:show.html.twig', array(
                        'seotool' => $ads
            ));
        } else {

            return $this->render('BidwebBundle:SeoToolSale:show2.html.twig', array(
                        'seotool' => $ads
            ));
        }
    }

    public function seotoolsAction() {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:SeoToolSale')->getLatestSeotool();


        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:SeoToolSale:seotools.html.twig', array(
                        'seotools' => $ads,
            ));
        } else {

            return $this->render('BidwebBundle:SeoToolSale:seotools2.html.twig', array(
                        'seotools' => $ads,
            ));
        }
    }

    /**
     * Confirm add add entry
     */
    public function confirmaddAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:SeoToolSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find seotool.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:SeoToolSale:confirmaddpost.html.twig', array(
                    'seotool' => $ads
        ));
    }

    /**
     * Create New Ads
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        //$request = $this->getRequest();
        $ads = new SeoToolSale();

        $form = $this->createForm(new SeoToolSaleType($em), $ads);
        $form->handleRequest($request);
        if ($this->getRequest()->isMethod('POST')) {
            if ($form->isValid()) {
                $ads->setUser($this->getUser());
                $ads->setSlug($ads->slugUrl($ads->getTitle()));
                $em->persist($ads);
                $em->flush();

                return $this->redirect($this->generateUrl('bidweb_seotool_confirm_add', array('id' => $ads->getId(), 'slug' => $ads->getSlug()))
                );
            }
        }

        return $this->render('BidwebBundle:SeoToolSale:create.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function editseotoolAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $seotool = $em->getRepository("BidwebBundle:SeoToolSale")->find($id);

        if (!$seotool) {
            throw $this->createNotFoundException('No seotool with this id = ' . $id);
        }
        
        $form = $this->createForm(new SeoToolSaleType(), $seotool);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $seotool->setSlug($seotool->slugUrl($seotool->getTitle()));
               
                $em->flush();
                return $this->redirect($this->generateUrl('bidweb_seotool_confirm_edit', array('id' => $seotool->getId(), 'slug' => $seotool->getSlug()))
                );
            }
        }
        return $this->render('BidwebBundle:SeoToolSale:edit.html.twig', array(
                    'form' => $form->createView(),'seotool'=>$seotool
        ));
    }
    
    /**
     * Confirm add add entry
     */
    public function confirmeditAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:SeoToolSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find seotool.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:SeoToolSale:confirmedit.html.twig', array(
                    'seotool' => $ads
        ));
    }

    public function innerseotoolAction(){
        $user=  $this->getUser();
        $em=  $this->getDoctrine()->getManager();
        $seotools=$em->getRepository("BidwebBundle:SeoToolSale")->findByUser($user->getId());
        return $this->render('BidwebBundle:SeoToolSale:innerpost.html.twig', array(
                    'seotools' => $seotools
        ));
    }
}

