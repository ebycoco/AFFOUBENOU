<?php

namespace App\Form;

use App\Entity\CommandePredefiniePerso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommandePredefiniePersoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile',VichImageType::class,[ 
                'required'=>false,
                'download_link' => false,
                'image_uri' => false,
                'label' => 'Image Filigrame',
                
            ])   
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandePredefiniePerso::class,
        ]);
    }
}
