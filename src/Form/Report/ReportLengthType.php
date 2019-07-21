<?php

namespace App\Form\Report;

use App\Entity\Report\ReportLength;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportLengthType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateTime', DateType::class, [
                'widget' => 'single_text',
                'input' => 'timestamp',
                'model_timezone' => 'Europe/Moscow',
                'view_timezone' => 'Europe/Moscow',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('length');
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReportLength::class,
        ]);
    }
}
