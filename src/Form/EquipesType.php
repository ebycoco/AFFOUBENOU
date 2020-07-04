<?php

namespace App\Form;

use App\Entity\Equipes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EquipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('imageFile',VichImageType::class,[ 
                'required'=>false
            ])
            ->add('description')
            ->add('profession')
            ->add('contact')
            ->add('email')
            ->add('sexe')  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipes::class,
        ]);
    }
}
