<?php

namespace Acme\ChildrenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DoctorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'name', 
                    null, 
                    array(
                            'label' => 'Name',
                            'attr' => array( 'class' => 'form-control', 'placeholder' =>'Name' )
                        )
                )
            ->add(
                    'surname',
                    null, 
                    array(
                            'label' => 'Surname',
                            'attr' => array( 'class' => 'form-control', 'placeholder' =>'Surname' )
                        )
                )
            //->add('contact')
            //->add('address')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\ChildrenBundle\Entity\Doctors'
        ));
    }

    public function getName()
    {
        return 'acme_childrenbundle_doctorstype';
    }
}
