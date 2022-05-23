<?php

namespace App\Form;

use App\Entity\Armor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArmorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('armorLabel', TextType::class, [
            'label' => 'Armorname'
        ]);
        $builder->add('armorHeadLabel', TextType::class, [
            'label' => 'Headarmor',
        ]);
        $builder->add('armorHeadValue', IntegerType::class, [
        ]);
        $builder->add('armorBodyLabel', TextType::class, [
            'label' => 'Bodyarmor'
        ]);
        $builder->add('armorBodyValue', IntegerType::class, [
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Armor::class,
        ]);
    }
}