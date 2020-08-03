<?php

namespace App\Form;

use App\Entity\CommandeFinalePerso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommandeFinalePersoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('imageFile',VichImageType::class,[ 
            'required'=>false,
            'download_link' => false,
            'image_uri' => false,
            'label' => 'Image Finale',
            
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeFinalePerso::class,
        ]);
    }
}
