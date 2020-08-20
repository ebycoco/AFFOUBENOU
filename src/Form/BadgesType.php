<?php

namespace App\Form;

use App\Entity\Badges;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BadgesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('info')
            ->add('quantite')
            ->add('prix')
            ->add('etat')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('user')
            ->add('predefinie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Badges::class,
        ]);
    }
}
