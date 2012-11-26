<?php

namespace Kix\WTProBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VehicleModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kix\WTProBundle\Entity\VehicleModel'
        ));
    }

    public function getName()
    {
        return 'kix_wtprobundle_vehiclemodeltype';
    }
}
