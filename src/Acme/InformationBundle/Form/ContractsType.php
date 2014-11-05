<?php

namespace Acme\InformationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContractsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'name',
                     null , 
                    array(
                            'label' => "Name",
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Name' )
                         )   
                )
            ->add(
                    'description',
                     null , 
                    array(
                            'label' => "Description",
                        //'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Description' )
                         )   
                )
            //->add('begin')
            //->add('dateEnd')
            //->add('children')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\InformationBundle\Entity\Contracts'
        ));
    }

    public function getName()
    {
        return 'acme_informationbundle_contractstype';
    }
}
