<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label'=>'Nombres',
                'attr'=>array(
                    'class'=>'au-input au-input--full',
                    'placeholder'=>'Juan',
                ),
            ])
            ->add('lastName', null, [
                'label'=>'Apellidos',
                'attr'=>array(
                    'class'=>'au-input au-input--full',
                    'placeholder'=>'Perez',
                ),
            ])
            ->add('photo', FileType::class, array(
                'label' => 'Foto de Perfil',
                'data_class'=>null,
            ))
//            ->add('staticPhoto')
            ->add('birthdate', BirthdayType::class,[
                'label'=>'Fecha de Nacimiento',
                'widget'=>'single_text',
                'format'=>'dd/MM/yyyy',
                'html5'=>false,
                'attr'=>array(
                    'autocomplete'=>'off',
                    'class'=>'datepicker au-input au-input--full',
                    'placeholder'=>'01/12/1999',
                ),
            ])
            ->add('gender', ChoiceType::class,[
                'label'=>'Genero',
                'choices'=>array(
                    'Hombre'=>'male',
                    'Mujer'=>'female',
                    'Otro'=>'other',
                ),
                'placeholder'=>'ph.select',
            ])
            ->add('email', null, [
                'label' => 'Correo Electronico',
                'attr'=>array(
                    'class'=>'au-input au-input--full',
                    'placeholder'=>'correo@ejemplo.com',
                ),
//                'placeholder'=>'john@example.com',
            ])
//            ->add('idUsuario')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Person',
            'attr'=>array('novalidate'=>'novalidate'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_person';
    }


}
