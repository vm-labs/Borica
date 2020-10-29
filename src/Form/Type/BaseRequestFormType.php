<?php

namespace Borica\Form\Type;

use Borica\Entity\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class BaseRequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('terminal', HiddenType::class, [
                'full_name' => 'TERMINAL',
            ])
            ->add('type', HiddenType::class, [
                'full_name' => 'TRTYPE',
            ])
            ->add('orderId', HiddenType::class, [
                'full_name' => 'ORDER',
            ])
            ->add('nonce', HiddenType::class, [
                'full_name' => 'NONCE',
            ])
            ->add('backref', HiddenType::class, [
                'full_name' => 'BACKREF',
            ])
            ->add('sign', HiddenType::class, [
                'full_name' => 'P_SIGN',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Request::class,
            'label' => false,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix() {
        return null;
    }
}
