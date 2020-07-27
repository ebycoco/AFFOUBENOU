<?php

namespace App\Form;

use App\Entity\Sliders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver; 
use Vich\UploaderBundle\Form\Type\VichImageType;

class SlidersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('imageFile',VichImageType::class,[ 
                'required'=>false,
                'download_link' => false,
                'image_uri' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sliders::class,
        ]);
    }
}
