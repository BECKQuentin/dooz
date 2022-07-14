<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'     => 'Votre nom (obligatoire)',
                'required'  => true,
            ])
            ->add('email', EmailType::class, [
                'label'     => 'Votre Email (obligatoire)',
                'required'  => true,
            ])
            ->add('subject', TextType::class, [
                'label'     => 'Sujet',
                'required'  => false,
            ])
            ->add('message', TextareaType::class, [
                'label'     => 'Message',
                'required'  => true,
            ])
            ->add('submit', SubmitType::class, [
                'label'     => 'Envoyer',
                'attr'      => [
                    'class' => 'btn-admin-dooz my-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
