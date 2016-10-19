<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bidweb\BidwebBundle\Entity\DomainSale;
use Bidweb\BidwebBundle\Form\DomainSaleType;

/**
 * Description of DomainController
 *
 * @author HAMMAMI
 */
class DomainController extends Controller {
    
    /**
     * Show a ads entry
     */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:DomainSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find Database.');
        }
//        $comments = $em->getRepository('BidwebBundle:Comment')
//                ->getCommentsForPost($ads->getId());

        
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:DomainSale:show.html.twig', array(
                        'domain' => $ads
            ));
        } else {

            return $this->render('BidwebBundle:DomainSale:show2.html.twig', array(
                        'domain' => $ads
            ));
        }
    }

    public function domainsAction() {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:DomainSale')->getLatestDomain();



        
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:DomainSale:posts.html.twig', array(
                        'domains' => $ads,
            ));
        } else {

            return $this->render('BidwebBundle:DomainSale:posts2.html.twig', array(
                        'posts' => $ads,
            ));
        }
    }

    /**
     * Confirm add add entry
     */
    public function confirmaddAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:DomainSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find domain.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:DomainSale:confirmaddpost.html.twig', array(
                    'domain' => $ads
        ));
    }

    /**
     * Create New Ads
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        //$request = $this->getRequest();
        $ads = new DomainSale();

        $form = $this->createForm(new DomainSaleType($em), $ads);
        $form->handleRequest($request);
        if ($this->getRequest()->isMethod('POST')) {
            if ($form->isValid()) {
                $ads->setUser($this->getUser());
                $ads->setSlug($ads->slugUrl($ads->getTitle()));
                $em->persist($ads);
                $em->flush();

                return $this->redirect($this->generateUrl('bidweb_domain_confirm_add', array('id' => $ads->getId(), 'slug' => $ads->getSlug()))
                );
            }
        }

        return $this->render('BidwebBundle:DomainSale:create.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function editdomainAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository("BidwebBundle:DomainSale")->find($id);

        if (!$domain) {
            throw $this->createNotFoundException('No domain with this id = ' . $id);
        }
        
        $form = $this->createForm(new DomainSaleType(), $domain);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $domain->setSlug($domain->slugUrl($domain->getTitle()));
               
                $em->flush();
                return $this->redirect($this->generateUrl('bidweb_domain_confirm_edit', array('id' => $domain->getId(), 'slug' => $domain->getSlug()))
                );
            }
        }
        return $this->render('BidwebBundle:DomainSale:edit.html.twig', array(
                    'form' => $form->createView(),'domain'=>$domain
        ));
    }
    
    /**
     * Confirm add add entry
     */
    public function confirmeditAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:DomainSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find domain.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:DomainSale:confirmedit.html.twig', array(
                    'domain' => $ads
        ));
    }

    public function innerdomainAction(){
        $user=  $this->getUser();
        $em=  $this->getDoctrine()->getManager();
        $domains=$em->getRepository("BidwebBundle:DomainSale")->findByUser($user->getId());
        return $this->render('BidwebBundle:DomainSale:innerpost.html.twig', array(
                    'posts' => $domains
        ));
    }
}

