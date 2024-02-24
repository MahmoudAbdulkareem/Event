<?php

namespace App\Form;

use App\Entity\CourseGestion\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\UserGestion\NormalUser;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddCourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("Title")
            ->add('Category')
            ->add('Thumbnail')
            ->add("Category")
            ->add("Rate")
            ->add("Description")
            ->add("Language")
            ->add("Price")
            ->add('owner', EntityType::class, [
                'class' => NormalUser::class, // Utilisez le nom complet de la classe Author
                'choice_label' => 'Name', // Utilisez la propriété 'username' de l'entité Author
            ])
            ->add("add_Course",SubmitType::class);
            ;
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
