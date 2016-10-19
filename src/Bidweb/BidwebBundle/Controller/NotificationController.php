<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bidweb\BidwebBundle\Entity\Notification;

/**
 * Description of NotificationController
 *
 * @author walid
 */
class NotificationController extends Controller{
    public function showAction(){
        
        $em=  $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if ($user === null) {
            return $this->render($this->generateUrl('fos_user_security_login'));
        }
        $notification = $em->getRepository('BidwebBundle:Notification')->getNotifications($user->getId());
        
        return $this->render('BidwebBundle:Notification:show.html.twig',array('notifications'=>$notification));
        
    }
    
    public function lastnotifAction(){
        $user = $this->getUser();
        if ($user === null) {
            return $this->render($this->generateUrl('fos_user_security_login'));
        }
        $em = $this->getDoctrine()->getManager();
        
        $message = $em->getRepository("BidwebBundle:Notification")->getNotifications($user->getId(),5);
        return $this->render('BidwebBundle:Notification:menumsg.html.twig', array(
                    'notifs' => $message
        ));
    }
    
    public function notificationAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $msgcount = null;
        if ($user) {
            $msgcount = $em->getRepository('BidwebBundle:Notification')
                    ->getNotifAccount($user->getId());
        } else {
            return $this->render($this->generateUrl('fos_user_security_login'));
        }
        return $this->render('BidwebBundle:Notification:notification.html.twig', array('msgCount' => $msgcount));
    }
    
    
    public function readAction($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $msgcount = null;
        if ($user) {
            $notif = $em->getRepository('BidwebBundle:Notification')
                    ->find($id);
            $notif->setRead(true);
            $em->persist($notif);
            $em->flush();
        } else {
            return $this->render($this->generateUrl('fos_user_security_login'));
        }
        return $this->render('BidwebBundle:Notification:read.html.twig', array('notif' => $notif));
    }
}
