<?php

namespace Bidweb\BidwebBundle\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostController
 *
 * @author HAMMAMI
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bidweb\BidwebBundle\Entity\Post;
use Bidweb\BidwebBundle\Form\PostType;

class PostController extends Controller {

    /**
     * Show a ads entry
     */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:Post')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find post.');
        }
        $comments = $em->getRepository('BidwebBundle:Comment')
                ->getCommentsForPost($ads->getId());

        return $this->render('BidwebBundle:Post:show.html.twig', array(
                    'post' => $ads, 'comments' => $comments
        ));
    }

    public function postsAction() {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:Post')->findAll();



        return $this->render('BidwebBundle:Post:posts.html.twig', array(
                    'posts' => $ads,
        ));
    }

    /**
     * Confirm add add entry
     */
    public function confirmaddAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:Post')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find post.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:Post:confirmaddpost.html.twig', array(
                    'post' => $ads
        ));
    }

    /**
     * Create New Ads
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        //$request = $this->getRequest();
        $ads = new Post();

        $form = $this->createForm(new PostType($em), $ads);
        $form->handleRequest($request);
        if ($this->getRequest()->isMethod('POST')) {
            if ($form->isValid()) {
                $ads->setUser($this->getUser());
                $ads->setSlug($ads->slugUrl($ads->getTitle()));
                $em->persist($ads);
                $em->flush();

                return $this->redirect($this->generateUrl('bidweb_ads_confirm_add', array('id' => $ads->getId(), 'slug' => $ads->getSlug()))
                );
            }
        }

        return $this->render('BidwebBundle:Post:create.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function editpostAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository("BidwebBundle:Post")->find($id);

        if (!$post) {
            throw $this->createNotFoundException('No post with this id = ' . $id);
        }
        
        $form = $this->createForm(new PostType(), $post);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $post->setSlug($post->slugUrl($post->getTitle()));
               
                $em->flush();
                return $this->redirect($this->generateUrl('bidweb_ads_confirm_edit', array('id' => $post->getId(), 'slug' => $post->getSlug()))
                );
            }
        }
        return $this->render('BidwebBundle:Post:edit.html.twig', array(
                    'form' => $form->createView(),'post'=>$post
        ));
    }
    
    /**
     * Confirm add add entry
     */
    public function confirmeditAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $ads = $em->getRepository('BidwebBundle:Post')->find($id);

        if (!$ads) {
            throw $this->createNotFoundException('Unable to find post.');
        }
//        $comments = $em->getRepository('BidwebBundle:CommentsTbl')
//                   ->getCommentsForAds($ads->getId());
//        
        return $this->render('BidwebBundle:Post:confirmedit.html.twig', array(
                    'post' => $ads
        ));
    }

    public function innerpostAction(){
        $user=  $this->getUser();
        $em=  $this->getDoctrine()->getManager();
        $posts=$em->getRepository("BidwebBundle:Post")->findByUser($user->getId());
        return $this->render('BidwebBundle:Post:innerpost.html.twig', array(
                    'posts' => $posts
        ));
    }
}
