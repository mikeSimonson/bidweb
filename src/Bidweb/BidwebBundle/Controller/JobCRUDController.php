<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

/**
 * Description of JobCRUDController
 *
 * @author HAMMAMI
 */
class JobCRUDController extends Controller{
    
    public function getCategoryOptionsFromTagAction($tagId)
    {   
        $html = ""; // HTML as response
        $tag = $this->getDoctrine()
            ->getRepository('BidwebBundle:State')
            ->find($tagId);

        $categories = $tag->getCities();

        foreach($categories as $cat){
            $html .= '<option value="'.$cat->getId().'" >'.$cat->getName().'</option>';
        }

        return new Response($html, 200);
    }
}
