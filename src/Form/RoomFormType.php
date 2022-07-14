<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomFormType extends AbstractType
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
            ->add('short_name', TextType::class, [
                'label'     => 'Accroche',
                'required'  => false
            ])
            ->add('short_name_en', TextType::class, [
                'label'     => 'Accroche Anglais',
                'required'  => false
            ])
            ->add('description', TextareaType::class, [
                'label'     => 'Description',
                'required'  => false,
                'attr' => ['class' => 'text_area'],
            ])
            ->add('description_en', TextareaType::class, [
                'label'     => 'Description Anglaise',
                'required'  => false,
                'attr' => ['class' => 'text_area'],
            ])
            ->add('banner', FileType::class, [
                'label'     => 'Bannière',
                'required'  => false,
                'mapped'    => false,
                'multiple'  => false,
            ])
            ->add('thumbnail', FileType::class, [
                'label'     => 'Miniature',
                'required'  => false,
                'mapped'    => false,
                'multiple'  => false,
            ])
            ->add('clock_thumbnail', FileType::class, [
                'label'     => 'Miniature de l \'horloge',
                'required'  => false,
                'mapped'    => false,
                'multiple'  => false,
            ])
            ->add('episode', TextType::class, [
                'required'  => false,
                'label'     => 'Numéro d\'épisode',
            ])
            ->add('address', EntityType::class, [
                'label'     => 'Adresse',
                'multiple'  => false,
                'class'     => Address::class,
                'choice_label' => 'name'
            ])
            ->add('forescape_data_room', TextType::class, [
                'label'     => '4Escape data-rooms (ex: 5d8a30775aa77b16a269cb42)',
                'required'  => false,
            ])
            ->add('isTextBanner', CheckboxType::class, [
                'label'     => 'Afficher texte bannière',
                'required'  => false,
            ])
            ->add('textBanner', TextType::class, [
                'label'     => 'Texte de Bannière',
                'required'  => false,
            ])
            ->add('isWarningDescription', CheckboxType::class, [
                'label'     => 'Afficher le warning',
                'required'  => false,
            ])
            ->add('warningDescription', TextareaType::class, [
                'label'     => 'Texte Prévention (en rouge)',
                'required'  => false,
            ])
            ->add('warningDescriptionEn', TextareaType::class, [
                'label'     => 'Texte Prévention Anglais',
                'required'  => false,
            ])
            ->add('difficulty', IntegerType::class, [
                'label'     => 'Difficulté /100',
                'required'  => false,
            ])
            ->add('stress', IntegerType::class, [
                'label'     => 'Stress /100',
                'required'  => false,
            ])
            ->add('fear', IntegerType::class, [
                'label'     => 'Peur /100',
                'required'  => false,
            ])
            ->add('min_players', IntegerType::class, [
                'label'     => 'Joueurs Minimum',
                'required'  => false,
            ])
            ->add('max_players', IntegerType::class, [
                'label'     => 'Joueurs Maximum',
                'required'  => false,
            ])
            ->add('duration', IntegerType::class, [
                'label'     => 'Durée (min)',
                'required'  => false,
            ])
            ->add('record', IntegerType::class, [
                'label'     => 'Record (min)',
                'required'  => false,
            ])
            ->add('record_lost', IntegerType::class, [
                'label'     => 'Record Abandon (min)',
                'required'  => false,
            ])
            ->add('main_mission', TextType::class, [
                'label'     => 'Mission Principale',
                'required'  => false
            ])
            ->add('main_mission_en', TextType::class, [
                'label'     => 'Mission Principale Anglais',
                'required'  => false
            ])
            ->add('side_mission', TextType::class, [
                'label'     => 'Mission secondaire',
                'required'  => false
            ])
            ->add('side_mission_en', TextType::class, [
                'label'     => 'Mission secondaire Anglais',
                'required'  => false
            ])
            ->add('additional_feature', TextType::class, [
                'label'     => 'Message supplémentaire',
                'required'  => false
            ])
            ->add('additional_feature_en', TextType::class, [
                'label'     => 'Message supplémentaire Anglais',
                'required'  => false
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
            'data_class' => Room::class,
        ]);
    }
}
