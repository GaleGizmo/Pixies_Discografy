<?php

namespace App\Form;

use App\Entity\Album;

use App\Entity\Cancion;
use CancionType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumFormType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
        
            ->add('titulo')
           
            ->add('fecha_publicacion')
            ->add('duracion')
            
            // ->add('canciones', EntityType::class, [
            //     'class' => Cancion::class,
                
            //     'choice_label' => 'titulo',
            //     'multiple' => true,
            //     'expanded' => true,
            //     'query_builder' => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('c')
            //             ->leftJoin('c.album', 'a')
            //             ->where('a.id IS NULL');
            //     },
            // ])
            ->add('sello')
            ->add('productor')
            ->add('ficheroImagen', FileType::class, [
                'label' => 'Imagen del Album',
                'mapped' => false
            ])
            
            ->add('enviar',  SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
