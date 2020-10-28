<?php

namespace Borica\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class StatusRequestFormType extends BaseRequestFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('amount', HiddenType::class, [
                'full_name' => 'AMOUNT',
            ])
        ;
    }
}
