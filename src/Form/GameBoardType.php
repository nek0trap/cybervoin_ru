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
        $builder->add('board', ChoiceType::class, [
                    'choices'  => [
                        'Street' => "111111",
                        'Battlefield' => "222222",
                        'Citadel' => "333333",
                        'Bar' => "111111111111111111111111144444444444444444134441144444404404404444111441144444111111111444134441144044444444444444111441144044443344404444134441144444444344404444111141144444044444444444444441144444044404444444444441144444444404444414444444140044444444444414444444144444004444004414444441144444444444444414000041111111111111111111111111"
                    ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GameBoard::class,
        ]);
    }
}