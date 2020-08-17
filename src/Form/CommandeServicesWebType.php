<?php

namespace App\Form;

use App\Entity\CommandeServicesWeb; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeServicesWebType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEntreprise')
            ->add('nomSite') 
            ->add('social1',TextType::class,[
                'required'=>false,
                'attr' =>[
                    'placeholder' => 'Facebook'
                ]
            ])
            ->add('social2',TextType::class,[
                'required'=>false,
                'attr' =>[
                    'placeholder' => 'Twitter'
                ]
            ])
            ->add('social3',TextType::class,[
                'required'=>false,
                'attr' =>[
                    'placeholder' => 'Instagram'
                ]
            ])
            ->add('social4',TextType::class,[
                'required'=>false,
                'attr' =>[
                    'placeholder' => 'Youtube'
                ]
            ])
            ->add('detail',TextareaType::class,[
                'required'=>false,
                'attr' =>[
                    'class' => 'form-control', 
                    'cols'=>"30",
                    'rows'=>"10",
                ]
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeServicesWeb::class,
        ]);
    }
}
