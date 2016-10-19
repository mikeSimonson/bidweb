<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Controller;

/**
 * Description of HistoryController
 *
 * @author walid
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class HistoryController extends Controller{
    //put your code here
    
    public function historyworkerAction(Request $request){
        return $this->render("BidwebBundle:History:history.worker.html.twig");
    }
    
    public function historyprojectAction(Request $request){
        return $this->render("BidwebBundle:History:history.project.html.twig");
    }
    
    public function historypaymentAction(Request $request){
        return $this->render("BidwebBundle:History:history.payment.html.twig");
    }
}
