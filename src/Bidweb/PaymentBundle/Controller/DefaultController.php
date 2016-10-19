<?php

namespace Bidweb\PaymentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BidwebPaymentBundle:Default:index.html.twig', array('name' => $name));
    }
}
