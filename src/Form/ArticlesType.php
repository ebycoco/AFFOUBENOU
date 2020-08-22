<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType; 
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('active')
            ->add('contenu',CKEditorType::class, [
                'config_name' => 'main_config',
                    ])
            ->add('imageFile',VichImageType::class,[ 
                'required'=>false,
                'allow_delete'=>true,
                'download_link' => false,
                'image_uri' => false,
                'label' => 'Image de l\'article (JPG or PNG file)',
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
