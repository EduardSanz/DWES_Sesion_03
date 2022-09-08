<?php

namespace App\Form\Type;

use App\Entity\Categorias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatagoriaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categoria', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorias::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return ''; // TODO: Change the autogenerated stub
    }

    public function getName() {
        return '';
    }
}