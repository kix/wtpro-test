<?php

namespace Kix\WTProBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('phone', null, array('label' => 'Phone (+7123456789 intl format, no spaces)'))
            ->add('age')
            ->add('isActive', null, array('required'=> false, 'label' => 'Is active?'))
            ->add('canDriveModels', null, array('label' => 'Can drive these models'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kix\WTProBundle\Entity\Driver',
        ));
    }

    public function getName()
    {
        return 'kix_wtprobundle_drivertype';
    }
}
