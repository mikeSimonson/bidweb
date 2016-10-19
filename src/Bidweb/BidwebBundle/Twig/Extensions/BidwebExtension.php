<?php

namespace Bidweb\BidwebBundle\Twig\Extensions;

class BidwebExtension extends \Twig_Extension
{
    private $translator;

    public function __construct(\Symfony\Component\Translation\TranslatorInterface $translator) {
        $this->translator = $translator;
    }

    public function getFilters()
    {
        return array(
            'created_ago' => new \Twig_Filter_Method($this, 'createdAgo'),
        );
    }

    public function createdAgo(\DateTime $dateTime)
    {
        $translator = $this->translator;
        
        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0)
            throw new \Exception("createdAgo is unable to handle dates in the future");

        $duration = "";
        if ($delta < 60)
        {
            // Seconds
            $time = $delta;
            $duration = $time . " ".$translator->trans('second') . (($time === 0 || $time > 1) ? "s" : "") . 
                    " ".$translator->trans('ago');
        }
        else if ($delta <= 3600)
        {
            // Mins
            $time = floor($delta / 60);
            $duration = $time . " minute" . (($time > 1) ? "s" : "") . " ".$translator->trans('ago');
        }
        else if ($delta <= 86400)
        {
            // Hours
            $time = floor($delta / 3600);
            $duration = $time . " hour" . (($time > 1) ? "s" : "") . " ".$translator->trans('ago');
        }
        else
        {
            // Days
            $time = floor($delta / 86400);
            $duration = $time . " day" . (($time > 1) ? "s" : "") . " ".$translator->trans('ago');
        }

        return $duration;
    }

    public function getName()
    {
        return 'adbck_extension';
    }
}