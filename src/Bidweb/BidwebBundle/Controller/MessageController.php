<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MessageController
 *
 * @author HAMMAMI
 */

namespace Bidweb\BidwebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bidweb\BidwebBundle\Entity\Message;
use Bidweb\BidwebBundle\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;
use \Bidweb\BidwebBundle\Form\MessageListType;
class MessageController extends Controller {

    public function msgboxAction($page) {
        
        $user = $this->getUser();
        if ($user === null) {
            return $this->render($this->generateUrl('BidwebBundle:Security:login.html.twig'));
        }
        $em = $this->getDoctrine()->getManager();
        
        $total = count( $em->getRepository("BidwebBundle:Message")->getLastMessages($user->getId()));
        
        $msgForm = $form = $this->createForm(new MessageListType($user->getId(),$page,10), null);
        
        $options = $msgForm->get('messages')->getConfig()->getOptions();
        $choices = $options['choice_list']->getChoices();
        
        return $this->render('BidwebBundle:Message:email.html.twig', array(
                    'form'=>$msgForm->createView(),
                    'choices'=>$choices,
                    'total'=>$total,
                    'page'=>$page
        ));
    }
    
    public function multideleteAction(Request $request){
        $user=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $message = $em->getRepository("BidwebBundle:Message")->getLastMessages($user->getId());
        
        $msgForm = $form = $this->createForm(new MessageListType($user->getId()), $message);
        $msgForm->handleRequest($request);
        
        if($request->isMethod('POST')){
            if ($msgForm->isValid()) {
                $options = $msgForm->get('messages');//->getConfig()->getOptions();
                $choices = $options->getConfig()->getOptions()['choice_list']->getChoices();
                foreach ($options as $key=>$ch) {
                    if($ch->getData()){
                        $msg = $choices[$key];
                        $em->remove($msg);
                    }
                    
                }
               $em->flush();
            }
        }
        
       return  $this->redirect($this->generateUrl('user_msg_box'));
    }
    public function msgsentAction($page) {
        
        $user = $this->getUser();
        if ($user === null) {
            return $this->render($this->generateUrl('BidwebBundle:Security:login.html.twig'));
        }
        $em = $this->getDoctrine()->getManager();
//        
        $total =  count( $em->getRepository("BidwebBundle:Message")->getLastMessagesSent($user->getId()));
//      
        $msgForm = $form = $this->createForm(new MessageListType($user->getId(),$page,10,false), null);
        
        $options = $msgForm->get('messages')->getConfig()->getOptions();
        $choices = $options['choice_list']->getChoices();
        
        return $this->render('BidwebBundle:Message:msg.sent.html.twig', array(
                    'form'=>$msgForm->createView(),
                    'choices'=>$choices,
                    'total'=>$total,
                    'page'=>$page
        ));
    }
    
    public function lastmsgAction(){
        $user = $this->getUser();
        if ($user === null) {
            return $this->render($this->generateUrl('BidwebBundle:Security:login.html.twig'));
        }
        $em = $this->getDoctrine()->getManager();
        
        $message = $em->getRepository("BidwebBundle:Message")->getLastMessages($user->getId(),5);
        return $this->render('BidwebBundle:Message:menumsg.html.twig', array(
                    'messages' => $message
        ));
    }

    public function sendmsgAction(Request $request, $receiver) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')
                ->find($receiver);

        if ($user === null) {
            
        } else {
            $msg = new Message();
            $sender = $this->getUser();


            $form = $this->createForm(new MessageType(), $msg);


            $form->handleRequest($request);
            if ($request->isMethod('POST')) {
               
                if ($form->isValid()) {
                    $msg->setSender($sender);
                    $msg->setReceiver($user);
                    $msg->setCreated(new \DateTime());
                    $msg->setMessage(htmlspecialchars($msg->getMessage()));

                    $msg->setRead(false);

                    $em->persist($msg);
                    $em->flush();

                    return $this->redirect($this->generateUrl('user_msg_box'));
                }else{
                    foreach ($form->getErrors() as $key => $error) {
                        echo $error->getMessage();
                         
                    } die;
                }
            }


            //$cities = $this->getDoctrine()->getManager()->getRepository('BidwebBundle:CitiesTbl')->getCityByState(7);
            // $cities = $repo->getCityByState(7);

            return $this->render('BidwebBundle:Message:sendmsg.html.twig', array(
                        'form' => $form->createView(), 'receiver' => $user
            ));
        }
    }

    public function readmsgAction($msgid) {
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $msg = $em->getRepository('BidwebBundle:Message')
                ->find($msgid);
        if ($user->getId() == $msg->getReceiver()->getId()) {
            $msg->setRead(true);

            $em->persist($msg);
        }
        $em->flush();
        return $this->render('BidwebBundle:Message:readmsg.html.twig', array(
                    'msg' => $msg
          
        ));
    }

    public function replymsgAction(Request $request, $msgid) {
        $em = $this->getDoctrine()->getManager();
        $originalmsg = $em->getRepository('BidwebBundle:Message')
                ->find($msgid);

       

        if ($originalmsg === null) {
            return $this->render($this->generateUrl('BidwebBundle:Security:login.html.twig'));
        } else {
            $msg = new Message();

            $sender = $this->getUser();
            $receiver = $originalmsg->getSender();
            $msg->setSubject('Re:' . $originalmsg->getSubject());
            $msg->setMessage('&#13;&#13;<Original message:&#13;' . $originalmsg->getMessage());
            $form = $this->createForm(new MessageType(), $msg);


            $form->handleRequest($request);
            if ($this->getRequest()->isMethod('POST')) {
                if ($form->isValid()) {
                    $msg->setSender($sender);
                    $msg->setReceiver($receiver);
                    $msg->setCreated(new \DateTime());

                    $msg->setRead(true);

                    $em->persist($msg);
                    $em->flush();

                    return $this->redirect($this->generateUrl('user_msg_box'));
                }
            }


            //$cities = $this->getDoctrine()->getManager()->getRepository('BidwebBundle:CitiesTbl')->getCityByState(7);
            // $cities = $repo->getCityByState(7);

            return $this->render('BidwebBundle:Message:sendmsg.html.twig', array(
                        'form' => $form->createView(), 'receiver' => $receiver
            ));
        }
    }

    public function deletemsgAction($msgid) {
        $em = $this->getDoctrine()->getManager();
        $msg = $em->getRepository('BidwebBundle:Message')
                ->find($msgid);

        $em->remove($msg);
        $em->flush();

        return $this->redirect($this->generateUrl('user_msg_box'));
    }

    public function mailmenuAction(){
        $em = $this->getDoctrine()->getManager();
         $user=$this->getUser();
         $count=$em->getRepository("BidwebBundle:Message")->getMessageAccount($user->getId());
         return $this->render('BidwebBundle:Message:mail.menu.html.twig', array(
            'count'=>$count
        ));
    }
    
    private function createDeleteForm($data){
        
        $formBuilder = $this->createFormBuilder($data);
        
        $formBuilder->add('messages', 'entity', array(
            'class' => 'BidwebBundle:Message',
            'property' => 'id',
            'required' => false,
            'expanded' => true,
            'multiple' => true,
        ));
        
        
    }
}
