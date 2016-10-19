<?php

namespace Bidweb\PaymentBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BidwebPaymentBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'PayumBundle';
    }
}
