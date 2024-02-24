<?php

// src/Form/EventType.php

namespace App\Form;

use App\Entity\EventGestion\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 12,
                        'maxMessage' => 'Name cannot be longer than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('location', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Location cannot be longer than {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Competition' => 'competition',
                    'Bootcamp' => 'bootcamp',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Choice([
                        'choices' => ['competition', 'bootcamp'],
                        'message' => 'Please choose a valid event type.',
                    ]),
                ],
            ])
            ->add('details', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('city', TextType::class, [
               
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
