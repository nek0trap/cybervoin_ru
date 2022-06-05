<?php

namespace App\Form;

use App\Entity\Cyberware;
use App\Entity\GameBoard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameBoardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('characters', ChoiceType::class, [
            'choices'  => [
                'Street' => null,
                'Battlefield' => true,
                'Citadel' => false,
                'Bar' => false
            ],
        ])

            ->add('board', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GameBoard::class,
        ]);
    }
}