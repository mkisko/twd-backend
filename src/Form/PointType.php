<?php

namespace App\Form;

use App\Entity\Layout;
use App\Entity\Point;
use App\Entity\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('latitude')
            ->add('longitude')
            ->add('type', ChoiceType::class, [
                'label' => '',
                'choices' => ['Автодорога' => '1', 'Пешеходная зона' => '2']
            ])
            ->add('layouts', null, [
                'label' => 'Слои',
                'class' => Layout::class,
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Point::class,
        ]);
    }
}
