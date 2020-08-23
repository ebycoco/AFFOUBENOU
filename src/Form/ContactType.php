<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom',TextType::class,[
                'attr' =>[
                    'class' => 'form-control formulaire-item',
                    'placeholder' => 'Votre Prenom'
                ]
            ])
            ->add('email',EmailType::class,[
                'attr' =>[
                    'class' => 'form-control formulaire-item',
                    'placeholder' => 'Votre E-mail'
                ]
            ])
            ->add('message',TextareaType::class,[
                'attr' =>[
                    'class' => 'form-control contact-textaerat', 
                    'cols'=>"30",
                    'rows'=>"10",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
