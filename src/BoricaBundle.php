<?php

namespace Borica;

use Borica\DependencyInjection\BoricaExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BoricaBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new BoricaExtension();
        }

        return $this->extension;
    }
}
