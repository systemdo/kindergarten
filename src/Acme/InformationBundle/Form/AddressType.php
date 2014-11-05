<?php

namespace Acme\InformationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'street', 
                    null , 
                    array(
                            'label' => "Street",
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Street' )
                         )   
                )
            ->add(
                    'number',
                    null , 
                    array(
                            'label' => "Number",
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Number' )
                         )   
                )
            ->add(
                    'complement',
                    null , 
                    array(
                            'label' => "Street",
                            'required' => false,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Street' )
                         )   
                )
            ->add(
                    'ciudad',
                    null , 
                    array(
                            'label' => "City",
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'City' )
                         )   
                )
            ->add(
                    'postcode',
                    null , 
                    array(
                            'label' => "Postcode",
                            'required' => false,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Postcode' )
                         )   
                )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\InformationBundle\Entity\Address'
        ));
    }

    public function getName()
    {
        return 'acme_informationbundle_addresstype';
    }
}
