<?php

namespace Acme\InformationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'phone', 
                    null , 
                    array(
                            'label' => "Phone",
                            'required' => true,
                                //'empty_value' => 'Not empty',
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Phone' )
                         )   
                )
            ->add(
                    'secondPhone',
                    null , 
                    array(
                            'label' => "Second Phone",
                            'required' => false,
                                //'empty_value' => 'Not empty',
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Second Phone' )
                         )   
                )
            ->add(
                    'email',
                    'email' , 
                    array(
                            'label' => "Email",
                            'required' => false,
                                //'empty_value' => 'Not empty',
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Email' )
                         )   
                )
            ->add(
                    'phoneJob',
                    null , 
                    array(
                            'label' => "Jobs Phone",
                            'required' => false,
                                //'empty_value' => 'Not empty',
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Jobs Phone' )
                         )       
                )
            ->add(
                    'secondPhoneJob',
                    null , 
                    array(
                            'label' => "Seconds Jobs Phone",
                            'required' => false,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Seconds Jobs Phone' )
                         )   
                )
            ->add(
                    'fax',
                    null , 
                    array(
                            'label' => "Fax",
                            'required' => false,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Fax' )
                         )   
                )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\InformationBundle\Entity\Contact'
        ));
    }

    public function getName()
    {
        return 'acme_informationbundle_contacttype';
    }
}
