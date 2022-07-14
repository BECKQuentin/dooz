<?php

namespace App\Form;

use App\Entity\CGV;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CGVFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'     => 'Nom',
                'required'  => true
            ])
            ->add('name_en', TextType::class, [
                'label'     => 'Nom Anglais',
                'required'  => true
            ])
            ->add('description', TextareaType::class, [
                'label'     => 'Description',
                'required'  => false,
                'attr' => ['class' => 'text_area'],
            ])
            ->add('description_en', TextareaType::class, [
                'label'     => 'Description Anglais',
                'required'  => false,
                'attr' => ['class' => 'text_area'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn-admin-dooz my-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CGV::class,
        ]);
    }
}
