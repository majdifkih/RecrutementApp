<?php

namespace App\Form;

use App\Entity\InternShip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternShipType extends OffreType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder,$options);
        $builder

            ->add('Payed',ChoiceType::class,[
                'choices'=>[
                    'YES'=>true,
                    'NO'=>false
            ],
                'expanded'=>true,
            ])
            ->add('Start_Date',DateType::class)
            ->add('end_date',DateType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InternShip::class,
        ]);
    }
}
