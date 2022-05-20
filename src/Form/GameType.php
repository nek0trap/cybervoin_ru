<?php

namespace App\Form;


use App\Entity\GameBoard;
use App\Entity\StatChar;
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

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Name', TextType::class)
        ->add('description', TextareaType::class)
        ->add('GameBoard', EntityType::class, [
            'class' => GameBoard::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('p')
                    ->orderBy('p.id', 'ASC');
            },
            'choice_label' => 'name',
            'label' => 'Preset'
            ])
        ->add('submit', SubmitType::class);
    }
}