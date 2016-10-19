<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Bidweb\PaymentBundle\Controller;
/**
 * Description of PaymentController
 *
 * @author HAMMAMI
 */
use Payum\Core\Request\GetHumanStatus;
use Payum\Core\Registry\RegistryInterface;
use Payum\Core\Security\GenericTokenFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Bidweb\PaymentBundle\Form\PaymentDetailsType;
use Bidweb\PaymentBundle\Form\PaymentDetailsOutType;
use Bidweb\PaymentBundle\Entity\PaymentDetails;
use PayPal\Core\PPLoggingManager;
use PayPal\PayPalAPI\MassPayReq;
use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\PayPalAPI\MassPayRequestItemType;
use PayPal\PayPalAPI\MassPayRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
/**
 * Description of PaymentController
 *
 * @author HAMMAMI
 */
class PaymentController extends Controller 
{

    
    public function paypaplExpressAction(Request $request,$email,$id){
        
        $gatewayName = 'paypal_express_checkout_and_doctrine_orm';
        $payment = new PaymentDetails();
        $sender = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $payment->setGatewayName($gatewayName);
        $receiver = $em->getRepository("UserBundle:User")->find($id) ;
        $payment->setCurrencyCode('USD');
        $payment->setSender($sender);
        $payment->setReceiver($receiver);
        $payment->setEmail($email);
        $form = $this->createForm(new PaymentDetailsType(), $payment);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
           
            $storage = $this->getPayum()->getStorage('Bidweb\PaymentBundle\Entity\PaymentDetails');
            $payment->setType('IN');
           
           
            $payment['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Sale';
            $payment['PAYMENTREQUEST_0_CURRENCYCODE'] = 'USD';//$payment->getCurrencyCode();
            $payment['PAYMENTREQUEST_0_AMT'] = $payment->getTotalAmount();
            $payment['PAYMENTREQUEST_0_ITEMAMT'] = $payment->getTotalAmount();
            $payment['PAYMENTREQUEST_0_DESC']= 'Freelancer payment in bidweb.org, Freelancer name: '.$receiver->getFirstName().' '.$receiver->getLastName();
            
            $payment['L_PAYMENTREQUEST_0_AMT0'] = $payment->getTotalAmount();
            $payment['L_PAYMENTREQUEST_0_NAME0']= 'Freelancer payment';
            $payment->setCreatedAt(new \DateTime());
          
            $storage->update($payment);

            $captureToken = $this->getTokenFactory()->createCaptureToken(
                $gatewayName,
                $payment,
                'bidweb_pay_done'
            );

            $payment['INVNUM'] = $payment->getId();
            
            $storage->update($payment);

            return $this->redirect($captureToken->getTargetUrl());
        }

        return $this->render('BidwebPaymentBundle:Payment:paypal.express.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function cashoutpaypaplAction(Request $request,$email,$id){
        
        $payment = new PaymentDetails();
        $sender = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $receiver = $em->getRepository("UserBundle:User")->find($id) ;
        $payment->setCurrencyCode('USD');
        $payment->setSender($sender);
        $payment->setReceiver($receiver);
        $payment->setClientEmail($email);
        $form = $this->createForm(new PaymentDetailsOutType(), $payment);
        $form->handleRequest($request);
        $payment->setType('OUT');
        
        $paymetreceiver = $em->getRepository('BidwebPaymentBundle:PaymentDetails')->findByReceiver($this->getUser()->getId());
        $total=0.0;
        foreach ($paymetreceiver as $pay){
            if($pay->getType()=='IN'){
                
                $total +=floatval($pay->getNetTotalAmount());
            }else{
                
                $total -=floatval($pay->getNetTotalAmount());
            }
        }
        if ($form->isValid()) {
            
            if($payment->getTotalAmount()>($total-($total*10/100))){
                echo ($total-($total*10/100));die;
                return $this->render('BidwebPaymentBundle:Payment:error.payout.html.twig',array('error'=>'Total amount not autorized'.($total-($total*10/100))));
            }
            $response = $this->massPay($payment->getClientEmail(),$payment->getTotalAmount());
            $storage = $this->getPayum()->getStorage('Bidweb\PaymentBundle\Entity\PaymentDetails');           
            if ($response->Ack == "Success") {
                
                $payment->setCreatedAt(new \DateTime());
                $payment->setNetTotalAmount($payment->getTotalAmount());
                $storage->update($payment);
                return $this->render('BidwebPaymentBundle:Payment:confirm.payout.html.twig');
            }
            // ### Error Values
            // Access error values from error list using getter methods
            // ### Error Values
            // Access error values from error list using getter methods
            else {
                return $this->render('BidwebPaymentBundle:Payment:error.payout.html.twig',array('error'=>'Total amount not autorized (test2 )'));
            }

            
        }

        return $this->render('BidwebPaymentBundle:Payment:cashout.express.html.twig', array(
            'form' => $form->createView(),'total'=>($total-($total*10/100))
        ));
    }

    public function doneAction(Request $request)
    {
        $token = $this->get('payum.security.http_request_verifier')->verify($request);

        $identity = $token->getDetails();
        $model = $this->get('payum')->getStorage($identity->getClass())->find($identity);
        //var_dump($model);die;
         $fee='0';
        if(isset($model['PAYMENTREQUEST_0_FEEAMT'])){
            $fee= $model['PAYMENTREQUEST_0_FEEAMT'];
        }else{
            $fee= '0';
        }
         
            
        $netPay = floatval($model->getTotalAmount()) - floatval($model->getTotalAmount()*floatval($fee)/100);
        $model->setFee($fee);
        $model->setNetTotalAmount($netPay);
        $gateway = $this->get('payum')->getGateway($token->getGatewayName());

       $gateway->execute($status = new GetHumanStatus($token));
        $details = $status->getFirstModel();
       
        if ($status->getValue()!='failed') {
            $model->setStatus(1);
            
            return $this->render('BidwebPaymentBundle:Payment:confirmpay.html.twig', array('details' => 'Transcation done.')
            );
        }else{
            $model->setStatus(0);
            return $this->render('BidwebPaymentBundle:Payment:confirmpay.html.twig', array('details' => 'There is an error please contact admin.')
            );
        }


//        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
//            'status' => $status->getValue(),
//            'details' => iterator_to_array($details),
//        ));
    }
    
    /**
     * @return \Symfony\Component\Form\Form
     */
    protected function createPurchaseForm()
    {
        $formBuilder = $this->createFormBuilder(null, array('data_class' => 'Bidweb\PaymentBundle\Entity\PaymentDetails'));
        return $formBuilder
            ->add('gateway_name', 'choice', array(
                'choices' => array(
                    'paypal_express_checkou' => 'Paypal ExpressCheckout',
//                    'paypal_pro_checkout' => 'Paypal ProCheckout',
//                    'stripe_js' => 'Stripe.Js',
//                    'stripe_checkout' => 'Stripe Checkout',
//                    'authorize_net' => 'Authorize.Net AIM',
//                    'be2bill' => 'Be2bill',
//                    'be2bill_offsite' => 'Be2bill Offsite',
//                    'payex' => 'Payex',
//                    'redsys' => 'Redsys',
//                    'offline' => 'Offline',
//                    'stripe_via_omnipay' => 'Stripe (Omnipay)',
//                    'paypal_express_checkout_via_omnipay' => 'Paypal ExpressCheckout (Omnipay)',
                ),
                'mapped' => false,
                'constraints' => array(new NotBlank())
            ))
            ->add('totalAmount', 'integer', array(
                'data' => 200,
                'constraints' => array(new Range(array('max' => 10000, 'min' => 10)), new NotBlank())
            ))
            ->add('currencyCode', 'text', array(
                'data' => 'USD',
                'constraints' => array(new NotBlank())
            ))
            ->add('clientEmail', 'text', array(
                'data' => 'foo@example.com',
                'constraints' => array(new Email(), new NotBlank())
            ))
            ->getForm()
        ;
    }
    /**
     * @return RegistryInterface
     */
    protected function getPayum()
    {
        return $this->get('payum');
    }
    /**
     * @return GenericTokenFactoryInterface
     */
    protected function getTokenFactory()
    {
        return $this->get('payum.security.token_factory');
    }
    
    public function walletAction(){
        $em  = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        
        $paymetreceiver = $em->getRepository('BidwebPaymentBundle:PaymentDetails')->findByReceiver($id);
        return $this->render('BidwebPaymentBundle:Payment:wallet.html.twig', array(
            'receive'=>$paymetreceiver
        ));
    }
    
    public function paymentsAction(){
        $em  = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $paymetSender = $em->getRepository('BidwebPaymentBundle:PaymentDetails')->findBySender($id);
        
        return $this->render('BidwebPaymentBundle:Payment:payed.html.twig', array(
            'send' => $paymetSender
        ));
    }
    
    public function massPay($email, $amount){
       
        $config = array("mode" => "live",
            'log.LogEnabled' => true,
            'log.FileName' => 'logpp/PayPal.log',
            'log.LogLevel' => 'FINE',
            "acct1.UserName" => "jiji0806_api1.gmail.com",
            "acct1.Password" => "XNHY82D87LVF4Y3C",
            "acct1.Signature" => "AYZKuoDwxfro3gk3FzRVQzXgMABuAGxDpyfOz34V0YWulUiqId56PrWo");

        $logger = new PPLoggingManager('MassPay',$config);
        // ## MassPayReq
        // Details of each payment.
        // `Note:
        // A single MassPayRequest can include up to 250 MassPayItems.`
        $massPayReq = new MassPayReq();
        $massPayItemArray = array();
        // `Amount` for the payment which contains
        //
		// * `Currency Code`
        // * `Amount`
        $amount1 = new BasicAmountType("USD", $amount);
        $massPayRequestItem1 = new MassPayRequestItemType($amount1);
        // Email Address of receiver
        $massPayRequestItem1->ReceiverEmail = $email;
       
       
        $massPayItemArray[1] = $massPayRequestItem1;
  

        $massPayRequest = new MassPayRequestType($massPayItemArray);
        $massPayReq->MassPayRequest = $massPayRequest;
        // ## Creating service wrapper object
        // Creating service wrapper object to make API call and loading
        // configuration file for your credentials and endpoint
        
        $service = new PayPalAPIInterfaceServiceService($config);
       
        try {
            // ## Making API call
            // Invoke the appropriate method corresponding to API in service
            // wrapper object
            $response = $service->MassPay($massPayReq);
        } catch (Exception $ex) {
            $logger->error("Error Message : " + $ex->getMessage());
        }

        // ## Accessing response parameters
        // You can access the response parameters using getter methods in
        // response object as shown below
        // ### Success values
        if ($response->Ack == "Success") {
           // $logger->log("Mass Pay successful");
        }
        // ### Error Values
        // Access error values from error list using getter methods
        // ### Error Values
        // Access error values from error list using getter methods
        else {
            $logger->error("API Error Message : " . $response->Errors[0]->LongMessage);
        }
        
        return $response;
    }
}