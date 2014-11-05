<?php

namespace Acme\ChildrenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChildrenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, 
                array(
                        'label' => "Name",
                        'required'    => true,
                        //'empty_value' => 'Not empty',
                        'attr' => array('class' => 'form-control' , 'placeholder' =>'Name' ),
                    )
                    )
            ->add(
                    'surname', 
                    null, 
                    array(
                            'label' => 'Surname',
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Surname' ),
                        )
                    )
            ->add('image', 'file', 
                array(
                        'required'    => false,
                        'attr' => array('class' => 'file_button'),  
                        'data_class' => 'Acme\SystemBundle\Entity\FilesSystem'
                     )
                )
            ->add('birth', null, array('required' => true, 'attr'=> array('class' => 'form-control birth')))
            
            ->add('dateStart', null, array('required' => true, 'attr'=> array('class' => 'form-control birth')))
            //actualizar en la base de datos 
            //->add('dateLeave')
            /*->add('status', null, array('label' => "Status",  
                                'attr' => array('class' => 'iphone-toggle' , "data-no-uniform" => "true", "type" => "checkbox"))
                    )*/
            //->add('isOnline')
            //->add('lastUpdate')
            //->add('dateCreate')
            ->add(
                    'contract',
                     null, 
                     array('required' =>true, 'attr'=> array('class' => 'form-control selectmenu'))
                )
            //->add('ermergencyDateId')
            ->add(
                    'kindergarten',
                     null, 
                     array('required' =>true, 'attr'=> array('class' => 'form-control selectmenu'))
                )
            //->add('family')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\ChildrenBundle\Entity\Children',
            //'data_class' => 'ContractsBundle\Entity\Contracts'
        ));
    }

    public function getName()
    {
        return 'acme_childrenbundle_childrentype';
    }
}
