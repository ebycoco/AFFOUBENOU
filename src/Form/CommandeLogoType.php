<?php

namespace App\Form;

use App\Entity\CommandeLogo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommandeLogoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile',VichImageType::class,[ 
                'required'=>false,
                'download_link' => false,
                'image_uri' => false,
                'label' => false,
                
            ]) 
            ->add('nomLogo',TextType::class, [
                'attr' => [
                    'class' => 'form-control name-couleur',
                    'placeholder' => 'nom du logo'
                ]
            ])
            ->add('couleur',TextType::class, [
                'required'=>false,
                'attr' => [ 
                    'class' => 'form-control name-couleur',
                    'placeholder' => 'Vos couleurs'
                ]
            ])
            ->add('modification',TextareaType::class,[
                'required'=>false,  
                'attr' =>[
                    'class' => 'form-control text-message',
                    'placeholder' => 'Ajouter tous les details',
                    'cols'=>"30",
                    'rows'=>"10",
                ]
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeLogo::class,
        ]);
    }
}
