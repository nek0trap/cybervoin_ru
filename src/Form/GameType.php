<?php

namespace App\Form;


use App\Entity\GameBoard;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
        ->add('submit', SubmitType::class)
        ->add('gameboardForm', CollectionType::class, [
            'entry_type' => GameBoardType::class,
            'label' => 'Gameboard:',
            'allow_add' => false,
        ]);
    }
}