<?php

namespace App\Form;

use App\Entity\Point;
use App\Entity\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('length')
            ->add('cost')
            ->add('priority')
            ->add('traffic')
            ->add('trafficJam')
            ->add('ecologic')
            ->add('points', CollectionType::class, [
                'label' => 'Точки',
                'entry_type' => PointType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
            ])
            ->add('nationalPrograms')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Route::class,
        ]);
    }
}
