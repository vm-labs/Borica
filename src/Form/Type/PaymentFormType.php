<?php

namespace Borica\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class PaymentFormType extends BaseRequestFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('amount', HiddenType::class, [
                'full_name' => 'AMOUNT',
            ])
            ->add('currency', HiddenType::class, [
                'full_name' => 'CURRENCY',
            ])
            ->add('description', HiddenType::class, [
                'full_name' => 'DESC',
            ])
            ->add('merchantUrl', HiddenType::class, [
                'full_name' => 'MERCH_URL',
            ])
            ->add('merchant', HiddenType::class, [
                'full_name' => 'MERCHANT',
            ])
            ->add('merchantName', HiddenType::class, [
                'full_name' => 'MERCH_NAME',
            ])
            ->add('email', HiddenType::class, [
                'full_name' => 'EMAIL',
            ])
            ->add('country', HiddenType::class, [
                'full_name' => 'COUNTRY',
            ])
            ->add('merchantGmt', HiddenType::class, [
                'full_name' => 'MERCH_GMT',
            ])
            ->add('timestamp', HiddenType::class, [
                'full_name' => 'TIMESTAMP',
            ])
            ->add('boricaOrderId', HiddenType::class, [
                'full_name' => 'AD.CUST_BOR_ORDER_ID',
            ])
            ->add('addendum', HiddenType::class, [
                'full_name' => 'ADDENDUM',
            ])
        ;
    }
}
