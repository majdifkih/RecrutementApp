<?php

namespace App\Form;

use App\Entity\Offre;
use App\Entity\Recruiter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Title')
            ->add('Limit_Date',DateType::class)
            ->add('Req_Skills',CollectionType::class,[
                'entry_type'=>TextareaType::class,
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->add('Mission',)
            ->add('Description',TextareaType::class)
//            ->add('Recruiter',EntityType::class,[
//                'class'=>Recruiter::class,
//                'choice_label'=>'first_name'
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
