<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Entity;

/**
 * Description of PaymentToken
 *
 * @author HAMMAMI
 */
use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Model\Token;

/**
 * @ORM\Table
 * @ORM\Entity
 */

class PaymentToken  extends Token{
    //put your code here
}
