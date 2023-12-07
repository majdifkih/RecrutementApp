<?php

namespace App\Form;

use App\Entity\Candidat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\DataTransformerInterface;
class CandidatType extends RegistrationFormType
{
    private $fileTransformer;

    public function __construct(FileTransformer $fileTransformer)
    {
        $this->fileTransformer = $fileTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        parent::buildForm($builder,$options);
        // Assuming $builder is your form builder and JsonToArrayTransformer is properly defined and imported.
        $builder
            ->add('birth_date', BirthdayType::class)
            ->add('adress', TextareaType::class)
            ->add('Phone_Number', TelType::class)
            ->add('skills', HiddenType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'custom-choices-input',
                ],
            ]);

// The transformer must be attached to 'skills' field immediately after it is defined
        $builder->get('skills')->addModelTransformer(new JsonToArrayTransformer());

// Continue adding fields to the form builder
        $builder
            ->add('cv', FileType::class);

// If you have a file transformer, it must be added immediately after the 'cv' field
        $builder->get('cv')->addModelTransformer($this->fileTransformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}