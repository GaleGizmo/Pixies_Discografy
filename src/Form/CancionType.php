<?php

use App\Entity\Album;
use App\Entity\Cancion;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CancionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cancion', EntityType::class, [
            'class' => Cancion::class,
            'choice_label' => 'titulo',
            'multiple'=>true,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
            ->leftJoin('c.album', 'a')
            ->where('a.id IS NULL');
            },
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cancion::class,
        ]);
    }
}
