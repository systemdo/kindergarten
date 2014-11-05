<?php

namespace Acme\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'password',
                    'password',
                    array(
                            'label' => 'New Password',
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'New Password' ),
                        )
                )->add(
                    'confirm_password',
                    'password',
                    array(
                            'label' => 'Confirm Password',
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Confirme Password' ),
                        )
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
