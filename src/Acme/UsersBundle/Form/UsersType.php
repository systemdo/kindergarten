<?php

namespace Acme\UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'username',
                     null,
                     array(
                            'label' => 'Username',
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Username' ),
                        )
                )
            ->add(
                    'employed',
                     null,
                     array(
                            'label' => 'employed',
                            'required' => true,
                            'attr' => array('class' => 'form-control selectable' , 'placeholder' =>'employed' ),
                        )
                )
            /*->add(
                    'password',
                    null,
                    array(
                            'label' => 'Password',
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Password' ),
                        )
                )*/
            //->add('salt')
            ->add(
                    'roles', 
                     null,
                    array('multiple' => false, 'required' => true, 'attr' => array('class' => 'form-control selectmenu'))
                )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\UsersBundle\Entity\Users'
        ));
    }

    public function getName()
    {
        return 'acme_usersbundle_userstype';
    }
}
