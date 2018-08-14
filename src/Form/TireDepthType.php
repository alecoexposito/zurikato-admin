<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Type;

class TireDepthType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('depthA',null, array('label' => 'Profundidad A'))
            ->add('depthB',null, array('label' => 'Profundidad B'))
            ->add('depthC',null, array('label' => 'Profundidad C'))
            ->add('observation', null, array('label' => 'Observación'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\TireDepth'
        ));
    }

    public function getName()
    {
        return 'tire_depth_type';
    }
}
