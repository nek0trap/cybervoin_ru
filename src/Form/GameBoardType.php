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
                        'Street' => "llpppppppppl@pppoppppllllnps<qpwwwpnlo>sp>qqplllllp<<<p<<<ollp>>p>>>plllnlcIpho<<<pllp>>>>pogllllllIllopupklnpkppuplnnnllnlllllllllllllllnllllnllllllllllllllllllllllllllllnlllllllnlllllllllllllllllllllllllllllllllllllllllllllllllllllnllllllnllllolllllllllllllllllllllllolllcoIkllllllllllllllllonllp<<olllllllllllllohoo@nlp<<pllllnllllll",
                        'Battlefield' => "cccefc6chekcggeec6cchekkddddddddddddddddddddddddzdddddddddddxdddvddddddddddddddxddbdddddbdddvvddddddddddzdzdvdddzdddddddddddzdddzddddxbdddvdxddddddddzddxdczddvdzdzddddddddzdddddzdddvdddvddcdddddxddzdxxddzdddxddxddddddddddddddvdddzxddddzddddddddddzddddvdddvdxdddzddddddddddddxddvcdddddxdddddddddddddddddddddddddddccfcfghcfccfchcecdcfccfc",
                        'Citadel' => "333333",
                        'Bar' => "11112111171111111111121114444444444444444413555114444444444444444411155114444b8888888888441355511940444a4a4a44444411155119a044444444b04444135551194444444444b0444411116114444b04444444444444444114444b044b04444444444441144444444b0444441444444414004444444444441444444414aa44044444004414444441144444a49994aa4414000041111111211111211111111111"
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