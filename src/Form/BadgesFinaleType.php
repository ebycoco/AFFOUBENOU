<?php

namespace App\Form;

use App\Entity\BadgesFinale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BadgesFinaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageName')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('user')
            ->add('badge')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BadgesFinale::class,
        ]);
    }
}
