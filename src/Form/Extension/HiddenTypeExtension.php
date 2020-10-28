<?php

namespace Borica\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HiddenTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['full_name']) {
            $builder->setAttribute('full_name', $options['full_name']);
        }
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if ($options['full_name']) {
            $view->vars['full_name'] = $options['full_name'];
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'full_name' => null,
        ]);
    }

    public function getExtendedType()
    {
        return HiddenType::class;
    }
}
