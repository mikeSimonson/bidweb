<?php
namespace Bidweb\BidwebBundle\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bidweb\BidwebBundle\Entity\DatabaseSale;
use Bidweb\BidwebBundle\Form\DatabaseSaleType;

/**
 * Description of DatabaseController
 *
 * @author HAMMAMI
 */
class DatabaseController extends Controller {
    
    /**
     * Show a ads entry
     */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:DatabaseSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find Database.');
        }
//        $comments = $em->getRepository('BidwebBundle:Comment')
//                ->getCommentsForPost($ads->getId());

        
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:DatabaseSale:show.html.twig', array(
                        'post' => $ads
            ));
        } else {

            return $this->render('BidwebBundle:DatabaseSale:show2.html.twig', array(
                        'post' => $ads
            ));
        }
    }

    public function databasesAction() {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:DatabaseSale')->getLatestDatabase();



        
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->render('BidwebBundle:DatabaseSale:posts.html.twig', array(
                        'databases' => $ads,
            ));
        } else {

            return $this->render('BidwebBundle:DatabaseSale:posts2.html.twig', array(
                        'databases' => $ads,
            ));
        }
    }

    /**
     * Confirm add add entry
     */
    public function confirmaddAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:DatabaseSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find database.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:DatabaseSale:confirmaddpost.html.twig', array(
                    'database' => $ads
        ));
    }

    /**
     * Create New Ads
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        //$request = $this->getRequest();
        $ads = new DatabaseSale();

        $form = $this->createForm(new DatabaseSaleType($em), $ads);
        $form->handleRequest($request);
        if ($this->getRequest()->isMethod('POST')) {
            if ($form->isValid()) {
                $ads->setUser($this->getUser());
                $ads->setSlug($ads->slugUrl($ads->getTitle()));
                $em->persist($ads);
                $em->flush();

                return $this->redirect($this->generateUrl('bidweb_database_confirm_add', array('id' => $ads->getId(), 'slug' => $ads->getSlug()))
                );
            }
        }

        return $this->render('BidwebBundle:DatabaseSale:create.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function editdatabaseAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $database = $em->getRepository("BidwebBundle:DatabaseSale")->find($id);

        if (!$database) {
            throw $this->createNotFoundException('No database with this id = ' . $id);
        }
        
        $form = $this->createForm(new DatabaseSaleType(), $database);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $database->setSlug($database->slugUrl($database->getTitle()));
               
                $em->flush();
                return $this->redirect($this->generateUrl('bidweb_database_confirm_edit', array('id' => $database->getId(), 'slug' => $database->getSlug()))
                );
            }
        }
        return $this->render('BidwebBundle:DatabaseSale:edit.html.twig', array(
                    'form' => $form->createView(),'database'=>$database
        ));
    }
    
    /**
     * Confirm add add entry
     */
    public function confirmeditAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:DatabaseSale')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find database.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:DatabaseSale:confirmedit.html.twig', array(
                    'database' => $ads
        ));
    }

    public function innerdatabaseAction(){
        $user=  $this->getUser();
        $em=  $this->getDoctrine()->getManager();
        $databases=$em->getRepository("BidwebBundle:DatabaseSale")->findByUser($user->getId());
        return $this->render('BidwebBundle:DatabaseSale:innerpost.html.twig', array(
                    'posts' => $databases
        ));
    }
}
