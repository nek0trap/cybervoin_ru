<?php

namespace App\Form;


use App\Entity\Armor;
use App\Entity\CharacterSkillPreset;
use App\Entity\CharacterStatsPreset;
use App\Entity\Weapon;
use App\Repository\WeaponRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('health', IntegerType::class)
            ->add('wounded', IntegerType::class)
            ->add('deathsave', IntegerType::class)
            ->add('guns', CollectionType::class, [
                'entry_type' => WeaponType::class,
                'allow_add' => true,
                'prototype' => true,
                'label' => 'Guns:',
            ])
            ->add('armors', CollectionType::class, [
                'entry_type' => ArmorType::class,
                'label' => 'Armor:',
                'allow_add' => true,
                'prototype' => true,
            ])
            ->add('cyberwares', CollectionType::class, [
                'entry_type' => CyberwareType::class,
                'label' => 'Cyberware:',
                'allow_add' => true,
                'prototype' => true,
            ])
            ->add('gears', CollectionType::class, [
                'entry_type' => GearType::class,
                'label' => 'Gear:',
                'allow_add' => true,
                'prototype' => true,
            ])
            ->add('stats', EntityType::class, [
                'class' => CharacterStatsPreset::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.id', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'Preset stats',
            ])
            ->add('skills', EntityType::class, [
                'class' => CharacterSkillPreset::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.id', 'ASC');
                },
                'choice_label' => 'name',
                'label' => 'Preset Skills'
            ])
            ->add('bio', TextareaType::class)
            ->add('SAVE', SubmitType::class);
    }
}

//            ->add('weapon', EntityType::class, [
//'class' => Weapon::class,
//                'query_builder' => function (EntityRepository $er) {
//    return $er->createQueryBuilder('p')
//        ->orderBy('p.id', 'ASC');
//},
//                'choice_label' => 'name',
//            ])