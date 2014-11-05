<?php

namespace Acme\KindergartenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttendanceEmployedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('date')
            //->add('clockIn')
            //->add('clockOut')
            ->add('employed')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\KindergartenBundle\Entity\AttendanceEmployed'
        ));
    }

    public function getName()
    {
        return 'acme_kindergartenbundle_attendanceemployedtype';
    }
}
