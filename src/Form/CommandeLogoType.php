<?php

namespace App\Form;

use App\Entity\CommandeLogo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
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
            ->add('couleur',ColorType::class, [
                'required'=>false,
                'attr' => [ 
                    'class' => 'form-control name-couleur',
                    'placeholder' => 'Vos couleurs'
                ]
            ])
            ->add('modification',CKEditorType::class, [
                'config_name' => 'main_config',
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
