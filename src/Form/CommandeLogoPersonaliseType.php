<?php

namespace App\Form;

use App\Entity\CommandeLogoPersonalise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommandeLogoPersonaliseType extends AbstractType
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
            ->add('nomLogo')
            ->add('couleur0',ColorType::class, [
                'label'=>'couleur 1',
                'required'=>false,
                'attr' => [ 
                    'class' => 'form-control name-couleur',
                    'placeholder' => 'couleur 1'
                ]
            ])
            ->add('couleur1',ColorType::class, [
                'required'=>false,
                'label'=>'couleur 2',
                'attr' => [ 
                    'class' => 'form-control name-couleur',
                    'placeholder' => 'couleur 2'
                ]
            ])
            ->add('couleur2',ColorType::class, [
                'label'=>'couleur 3',
                'required'=>false,
                'attr' => [ 
                    'class' => 'form-control name-couleur',
                    'placeholder' => 'couleur 3'
                ]
            ])
            ->add('couleur3',ColorType::class, [
                'label'=>'couleur 4',
                'required'=>false,
                'attr' => [ 
                    'class' => 'form-control name-couleur',
                    'placeholder' => 'couleur 4'
                ]
            ])
            ->add('modification',CKEditorType::class, [
                'config_name' => 'main_config',
                    ]) 
            ->add('typeLogo',ChoiceType::class,[
                'choices' => $this->getChoices()
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeLogoPersonalise::class,
        ]);
    }

    public function getChoices()
    {
       $choices = CommandeLogoPersonalise::TYPELOGO;
       $output = [];
       foreach ($choices as $k => $v) {
           $output[$v] =$k;
           
       }
       return $output;
    }
}
