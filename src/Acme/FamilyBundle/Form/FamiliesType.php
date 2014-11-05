<?php

namespace Acme\FamilyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FamiliesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'name', 
                    null,
                    array(
                            'label' => 'Name',
                            'required' => true,
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
                    'job',
                    null,
                    array(
                            'label' => 'Job',
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Job' ),
                        )

                )
            //->add('birth')
            //->add('document')
            //->add('dateCreate')
            //->add('lastUpdate')
            ->add(
                    'parentage', 
                    null,
                    array(
                            'label' => 'Parentage',
                            'required' => true,
                            'attr' => array('class' => 'form-control' , 'placeholder' =>'Parentage' ),
                        )
                )
            //->add('address', 'text')
            //->add('addressJob')
            //->add('contact')
            //->add('ourChildren')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FamilyBundle\Entity\Families'
        ));
    }

    public function getName()
    {
        return 'acme_familybundle_familiestype';
    }
}
