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
use Symfony\Component\Validator\Constraints\File;

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
//            ->add('skills', HiddenType::class, [
//                'label' => false,
//                'attr' => [
//                    'class' => 'custom-choices-input',
//                ],
//            ]);
//        $builder->get('skills')->addModelTransformer(new JsonToArrayTransformer());
            ->add('cv', FileType::class,[
                'constraints' => [ new File([
                                        'maxSize' => '10240k',
                                        'mimeTypes' => [
                                        'application/pdf',
                                        'application/x-pdf',
            ],
            'mimeTypesMessage' => 'Please upload a valid PDF document',
        ])]],
            );
        $builder->get('cv')->addModelTransformer($this->fileTransformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}