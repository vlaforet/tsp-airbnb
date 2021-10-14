<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('summary', null, ['label' => 'Résumé'])
            ->add('description', null, ['label' => 'Description'])
            ->add('capacity', null, ['label' => 'Capacité (TB)'])
            ->add('superficy', null, ['label' => 'Vitesse (MB/s)'])
            ->add('price', null, ['label' => 'Prix (€/TB/mois)'])
            ->add('address', null, ['label' => 'Addresse'])
            ->add('Regions', null, ['label' => 'Régions'])
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
            'data_class' => Room::class,
        ]);
    }
}
