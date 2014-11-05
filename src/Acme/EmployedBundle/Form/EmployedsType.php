<?php

namespace Acme\EmployedBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployedsType extends AbstractType
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
            ->add(
                    'email', 
                    'email', 
                    array(
                            'label' => 'email',
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'email' ),
                        )
                    )
            ->add('image', 'file', 
                array(
                        'required'    => false,
                        'attr' => array('class' => 'file_button'),  
                        'data_class' => 'Acme\SystemBundle\Entity\FilesSystem'
                     )
                )
            ->add(
                    'birth', 
                    null, 
                    array(
                            'label' => 'Birth',
                            'required' => true,
                            'attr' => array('class' => 'form-control birth' , 'placeholder' =>'Birth' ),
                        )
                    )
            ->add(
                    'schedule',
                    null,
                    array(
                        'label' => "Schedule",
                        'required'    => true,
                        //'empty_value' => 'Not empty',
                        'attr' => array('class' => 'form-control' , 'placeholder' =>'Schedule' ),
                    )

                )
            ->add('task', null, 
                array(
                        'label' => "Task",
                        'required'    => true,
                        //'empty_value' => 'Not empty',
                        'attr' => array('class' => 'form-control' , 'placeholder' =>'Task' ),
                    )
                    )
            //->add('begin')
            //->add('ended')*/
            //->add('address')
           ->add(
                    'kindergarten',
                     null, 
                     array(
                            'required' =>true, 
                            'multiple' => true, 
                            'attr'=> array('class' => 'form-control selectable')
                        )
                )
            //->add('contact')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\EmployedBundle\Entity\Employeds'
        ));
    }

    public function getName()
    {
        return 'acme_employedbundle_employedstype';
    }
}
