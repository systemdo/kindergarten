<?php

namespace Acme\InformationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class KindergartensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                     'name',
                     null,
                     array
                     (
                         'label' => "Name",
                        'required' => true,
                        'attr' => array('class' => 'form-control' , 'placeholder' =>'Name' )
                    )    
                )
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\InformationBundle\Entity\Kindergartens'
        ));
    }

    public function getName()
    {
        return 'acme_informationbundle_kindergartenstype';
    }
}
