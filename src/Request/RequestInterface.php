<?php

namespace Borica\Request;

use Borica\Entity\Request;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;

interface RequestInterface
{
    public function getForm(): Form;
    public function getData(): Request;
    public function isValidData(): bool;
    public function getErrorList(): ConstraintViolationList;
}
