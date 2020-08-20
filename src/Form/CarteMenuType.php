<?php

namespace App\Form;

use App\Entity\CarteMenu;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarteMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('menus',CKEditorType::class, [
                'config_name' => 'main_config',
                    ])
            ->add('contact')
            ->add('lieu') 
            ->add('quantite')
            ->add('info',CKEditorType::class, [
                'config_name' => 'main_config',
                    ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CarteMenu::class,
        ]);
    }
}
