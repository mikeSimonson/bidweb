<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Bidweb\BidwebBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Description of LocaleListener
 *
 * @author HAMMAMI
 */
class LocaleListener implements EventSubscriberInterface{
   private $defaultLocale;

    public function __construct($defaultLocale = 'en_US')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $locale = $request->getLocale();
       // echo $locale;
        if (!$request->hasPreviousSession()) {
            return;
        }

        // on essaie de voir si la locale a été fixée dans le paramètre de routing _locale
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            //echo $request->getSession()->get('_locale', $this->defaultLocale);die;
            // si aucune locale n'a été fixée explicitement dans la requête, on utilise celle de la session
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            // doit être enregistré avant le Locale listener par défaut
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}
