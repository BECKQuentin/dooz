<?php

namespace App\Form;

use App\Entity\Partners;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('thumbnail', FileType::class, [
                'label' => 'Logo',
                'required' => false,
                'mapped'    => false,
                'multiple'  => false,
            ])
            ->add('link', TextType::class, [
                'label' => 'Lien',
                'required' => true,
            ])
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
            'data_class' => Partners::class,
        ]);
    }
}
