<?php

// src/Form/CompetitionType.php

namespace App\Form;

use App\Entity\EventGestion\Competition;
use App\Entity\EventGestion\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('event', EntityType::class, [
            'class' => Event::class, // Utilisez le nom complet de la classe Author
            'choice_label' => 'Name', // Utilisez la propriété 'username' de l'entité Author
        ])
            ->add('Name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Name cannot be longer than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('Location', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Location cannot be longer than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('Description', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '/^\s*(?:\S+\s+){0,39}\S+\s*$/',
                        'message' => 'Description cannot contain more than 40 words.',
                    ]),
                ],
            ])
            ->add('Groupe', ChoiceType::class, [
                'choices' => [
                    'Group A' => 1,
                    'Group B' => 2,
                    'Group C' => 3,
                ],
                'constraints' => [
                    new NotBlank(),
                    new Choice([
                        'choices' => [1, 2, 3],
                        'message' => 'Please choose a valid group.',
                    ]),
                ],
            ]);
    }   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
