<?php

namespace Borica\Form\Type;

use Borica\Entity\Response;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('TERMINAL', HiddenType::class, [
                'property_path' => 'terminal',
            ])
            ->add('TRTYPE', HiddenType::class, [
                'property_path' => 'type',
            ])
            ->add('ORDER', HiddenType::class, [
                'property_path' => 'orderId',
            ])
            ->add('AMOUNT', HiddenType::class, [
                'property_path' => 'amount',
            ])
            ->add('CURRENCY', HiddenType::class, [
                'property_path' => 'currency',
            ])
            ->add('ACTION', HiddenType::class, [
                'property_path' => 'action',
            ])
            ->add('RC', HiddenType::class, [
                'property_path' => 'responseCode',
            ])
            ->add('APPROVAL', HiddenType::class, [
                'property_path' => 'approval',
            ])
            ->add('RRN', HiddenType::class, [
                'property_path' => 'rrn',
            ])
            ->add('INT_REF', HiddenType::class, [
                'property_path' => 'intRef',
            ])
            ->add('tran_trtype', HiddenType::class, [
                'property_path' => 'transactionType',
            ])
            ->add('statusMsg', HiddenType::class, [
                'property_path' => 'statusMsg',
            ])
            ->add('card', HiddenType::class, [
                'property_path' => 'card',
            ])
            ->add('tranDate', HiddenType::class, [
                'property_path' => 'tranDate',
            ])
            ->add('TIMESTAMP', HiddenType::class, [
                'property_path' => 'timestamp',
            ])
            ->add('PARES_STATUS', HiddenType::class, [
                'property_path' => 'paresStatus',
            ])
            ->add('ECI', HiddenType::class, [
                'property_path' => 'eci',
            ])
            ->add('NONCE', HiddenType::class, [
                'property_path' => 'nonce',
            ])
            ->add('P_SIGN', HiddenType::class, [
                'property_path' => 'sign',
            ])
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
