<?php

namespace App\Form;

use App\Entity\CarteVisite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CarteVisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('profession',TextType::class)
            ->add('nomSociete',TextType::class)
            ->add('contact1',IntegerType::class)
            ->add('contact2',IntegerType::class,[
                'required'=>false,
            ])
            ->add('email',EmailType::class,[
                'required'=>false,
            ])
            ->add('addressDuSite',TextType::class,[
                'required'=>false,
            ])
            ->add('numeroFixe',IntegerType::class,[
                'required'=>false,
            ])
            ->add('lieu',TextType::class)
            ->add('imageFile',VichImageType::class,[ 
                'required'=>false,
                'download_link' => false,
                'image_uri' => false,
                'label' => 'Image de l\'article',
                
            ])
            ->add('quantite',IntegerType::class)
            ->add('social',TextType::class)
            ->add('autresInfor',TextareaType::class,[
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
            'data_class' => CarteVisite::class,
        ]);
    }
}
