<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'     => 'Nom',
                'required'  => true,
            ])
            ->add('name_en', TextType::class, [
                'label'     => 'Nom Anglais',
                'required'  => false,
            ])
            ->add('description', TextareaType::class, [
                'label'     => 'Description',
                'required'  => false,
            ])
            ->add('description_en', TextareaType::class, [
                'label'     => 'Description Anglais',
                'required'  => false,
            ])
            ->add('beginDate', DateTimeType::class, [
                'label'     => 'Date de début',
                'required'  => false,
                'data' => new \DateTime()
            ])
            ->add('endDate', DateTimeType::class, [
                'label'     => 'Date de Fin',
                'required'  => false,
                'data' => new \DateTime()
            ])
//            ->add('adress')
            ->add('submit', SubmitType::class, [
                'label'     => 'Valider',
                'attr'      => [
                    'class' => 'btn-admin-dooz my-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
