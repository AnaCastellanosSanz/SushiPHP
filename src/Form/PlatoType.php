<?php

namespace App\Form;

use App\Entity\Ingrediente;
use App\Entity\Plato;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PlatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
               'label'=> 'Nombre del plato',
               'help'=> 'Introduce el nombre del plato',
               'attr' => ['placeholder' => 'Ej. nigiri'] 
            ])
            ->add('descripcion')
            ->add('imagenPlato', FileType::class, ['mapped' => false])
            ->add('precio')
            ->add('ingredientes', EntityType::class, [
                // looks for choices from this entity
                'class' => Ingrediente::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'nombre',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('enviar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plato::class,
        ]);
    }
}

