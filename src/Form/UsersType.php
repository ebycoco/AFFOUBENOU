<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
                'attr' =>[
                    'class' => 'effet-ombre',
                    'placeholder' => 'Votre E-mail'
                ]
            ]) 
            ->add('nom',TextType::class,[
                'attr' =>[
                    'class' => 'effet-ombre',
                    'placeholder' => 'Votre Nom'
                ]
            ])
            ->add('prenom',TextType::class,[
                'attr' =>[
                    'class' => 'effet-ombre',
                    'placeholder' => 'Votre Prenom'
                ]
            ])
            ->add('numeroTel',IntegerType::class,[
                'attr' =>[
                    'class' => 'effet-ombre',
                    'placeholder' => 'Votre Numéro du téléphone'
                ]
            ])
            ->add('adresse',TextType::class,[
                'attr' =>[
                    'class' => 'effet-ombre',
                    'placeholder' => 'Votre Adresse postale (ex:Abidjan 08)'
                ]
            ])
            ->add('ville',TextType::class,[
                'attr' =>[
                    'class' => 'effet-ombre',
                    'placeholder' => 'Votre Ville / Commune'
                ]
            ])
            ->add('sexe',ChoiceType::class,[
                'choices' => $this->getChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }

    public function getChoices()
    {
       $choices = Users::SEXE;
       $output = [];
       foreach ($choices as $k => $v) {
           $output[$v] =$k;
           
       }
       return $output;
    }
}
