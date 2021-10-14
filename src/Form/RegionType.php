<?php

namespace App\Form;

use App\Entity\Region;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Nom'])
            ->add('presentation', null, ['label' => 'Présentation'])
            ->add('country', null, ['label' => 'Code Pays'])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label' => 'Image',
                'delete_label' => 'Supprimer l\'image',
                'download_label' => 'Télécharger l\'image',
                'download_uri' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Region::class,
        ]);
    }
}
