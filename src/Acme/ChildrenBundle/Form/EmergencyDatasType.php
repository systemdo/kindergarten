<?php

namespace Acme\ChildrenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmergencyDatasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'healthInsurance',
                     null,
                    array(
                            'label' => 'Health Insurance',
                            'attr' => array( 'class' => 'form-control' , 'placeholder' => 'Health Insurance' )
                        ) 
                )
            ->add(
                    'anotherContact',
                     null,
                    array(
                            'label' => 'Another Contact', 
                            'attr' => array('class' => 'form-control' , 'row' => '6','placeholder' => 'Health Insurance' )
                        ) 
                )
            ->add(
                    'vaccine',
                     null,
                    array(
                            'required' => false,
                            'multiple'  => true,
                            'empty_value' => 'Choose an option',
                            'label' => 'Vaccines',
                            'attr' => array('class' => 'controls form-control' , 'placeholder' => 'Health Insurance' )

                        ) 
                 )
            //->add('doctorId')
            //->add('childrenSos', )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\ChildrenBundle\Entity\EmergencyDatas'
        ));
    }

    public function getName()
    {
        return 'acme_childrenbundle_emergencydatastype';
    }
}
