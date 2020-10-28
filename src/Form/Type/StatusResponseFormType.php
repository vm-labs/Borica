<?php

namespace Borica\Form\Type;

use Borica\Entity\Response;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatusResponseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('terminal', HiddenType::class)
            ->add('actionCode', HiddenType::class, [
                'property_path' => 'action',
            ])
            ->add('responseCode', HiddenType::class, [
                'property_path' => 'rc',
            ])
            ->add('statusMsg', HiddenType::class)
            ->add('orderID', HiddenType::class, [
                'property_path' => 'order',
            ])
            ->add('tr_type', HiddenType::class, [
                'property_path' => 'type',
            ])
            ->add('card', HiddenType::class)
            ->add('amount', HiddenType::class)
            ->add('currency', HiddenType::class)
            ->add('tran_trtype', HiddenType::class, [
                'property_path' => 'transactionType',
            ])
            ->add('tranDate', HiddenType::class)
            ->add('rrn', HiddenType::class)
            ->add('approval', HiddenType::class)
            ->add('eci', HiddenType::class)
            ->add('intRef', HiddenType::class)
            ->add('nonce', HiddenType::class)
            ->add('signature', HiddenType::class, [
                'property_path' => 'sign',
            ])
            ->add('timestamp', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Response::class,
            'label' => false,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix() {
        return null;
    }
}
