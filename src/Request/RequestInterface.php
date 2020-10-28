<?php

namespace Borica\Request;

use Borica\Entity\Request;

interface RequestInterface
{
    public function getFormType(): string;
    public function getData(): Request;
}
