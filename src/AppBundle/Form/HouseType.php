<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HouseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('latitude', null, [
                'label'=>'Longitud',
            ])
            ->add('longitude', null,[
                'label'=>'Latitud',
            ])
            ->add('name', null, [
                'label'=>'Nombre de la Casa',
            ])
            ->add('photo', FileType::class,[
                'label'=>'Foto',
                'data_class'=>null,
            ])
//            ->add('staticPhoto')
//            ->add('idPerson')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\House',
            'attr'=>array('novalidate'=>'novalidate'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_house';
    }


}
