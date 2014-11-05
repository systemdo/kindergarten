<?php

namespace Acme\KindergartenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttendanceChildrenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attendance')
            ->add('date')
            ->add('lastUpdate')
            ->add('dateCreate')
            ->add('child')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\KindergartenBundle\Entity\AttendanceChildren'
        ));
    }

    public function getName()
    {
        return 'acme_kindergartenbundle_attendancechildrentype';
    }
}
