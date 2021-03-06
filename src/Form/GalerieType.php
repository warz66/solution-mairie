<?php

namespace App\Form;

use App\Entity\Galerie;
use Symfony\Component\Form\AbstractType;
use App\Service\MessageDependenciesService;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class GalerieType extends AbstractType
{   
    private $md;
    
    public function __construct(MessageDependenciesService $md) {
        $this->md = $md;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre', 'attr' => ['placeholder' => 'Veuillez choisir un titre', 'maxlength' => '100'],'label_attr' => ['class' => 'font-weight-bold']])
            ->add('description', TextareaType::class, ['label' => 'Description', 'required' => false, 'label_attr' => ['class' => 'font-weight-bold'], 'attr' => ['placeholder' => 'Veuillez décrire la galerie', 'spellcheck' => 'false', 'maxlength' => '255', 'rows' => '3', 'style' => 'resize:none; overflow:hidden;']])
            ->add('imageFile', VichImageType::class, ['label' => 'Image de couverture', 'label_attr' => ['class' => 'font-weight-bold'], 'required' => false, 'allow_delete' => false, 'download_label' => false,'download_uri' => false,'imagine_pattern' => 'galerie_cover_edit', 'attr' => ['accept' => '.jpg, .png']])
            ->add('order_by', ChoiceType::class, ['label' => 'Trier par ordre', 'label_attr' => ['class' => 'font-weight-bold'], 'choices' => ['Croissant' => true, 'Décroissant' => false], 'placeholder' => false])
            ->add('statut', CheckboxType::class, ['required' => false, 'attr' => ['msgdependencies' => $this->md->getMsgGalerieDependencies($builder->getData())]])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'data' => $options['pagination'],
                'mapped' => false, // info : https://symfony.com/doc/current/reference/forms/types/collection.html#mapped
                'allow_add' => false,
                'allow_delete' => false, // info : https://symfony.com/doc/current/reference/forms/types/collection.html#allow-delete
                'attr' => ['class' => 'grid are-images-unloaded'],
                'label' => false,  
                'allow_extra_fields' => true,
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Galerie::class,
            'pagination' => null,
        ]);
    }
}
