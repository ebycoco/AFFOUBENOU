<?php

namespace App\Form;
use App\Entity\Categorie;

use App\Entity\ServicesGraphisme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ServicesGraphismeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('imageFile',VichImageType::class,[ 
                'required'=>false,
                'download_link' => false,
                'image_uri' => false,
                'label' => 'Image de l\'article',
                
            ])
            ->add('nom')   
            ->add('prix')   
            ->add('categorie',EntityType::class,[
                'class'=>Categorie::class,
                'choice_label'=>'nom',
                'multiple'=>false,
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ServicesGraphisme::class,
        ]);
    }
}
