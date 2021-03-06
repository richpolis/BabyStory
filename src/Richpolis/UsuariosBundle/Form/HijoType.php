<?php

namespace Richpolis\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Richpolis\UsuariosBundle\Entity\Hijo;

class HijoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text',array('label'=>'Nombre','attr'=>array(
                'class'=>'validate[required] form-control placeholder',
                'placeholder'=>'Nombre',
                'data-bind'=>'value: nombre'
             )))
            ->add('apodo','text',array('label'=>'Apodo','attr'=>array(
                'class'=>'validate[required] form-control placeholder',
                'placeholder'=>'Apodo',
                'data-bind'=>'value: apodo'
             )))
            ->add('usarApodo')
            ->add('sexo','choice',array(
                'label'=>'Es',
                'empty_value'=>false,
                'read_only'=> true,
                'choices'=>  Hijo::getArraySexo(),
                'preferred_choices'=>  Hijo::getPreferedSexo(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Es',
                    'data-bind'=>'value: es'
                )))       
            ->add('fechaNacimiento','date',array('label'=>'Fecha nacimiento','widget' => 'single_text',
                'format' => 'yyyy-MM-dd','attr'=>array('class'=>'form-control')))
            ->add('biografia',null,array('label'=>'Biografia','attr'=>array(
                'class'=>'validate[required] form-control placeholder',
                'placeholder'=>'Biografia',
                'data-bind'=>'value: biografia'
             )))
            ->add('file','file',array('label'=>'Imagen',
                'required'=>false,
                'attr'=>array(
                    'class'=>'form-control placeholder',
                    'placeholder'=>'Imagen usuario',
                    'data-bind'=>'value: imagen usuario'
             )))  
            ->add('imagen','hidden')
            ->add('papa',null,array('label'=>'Usuario','attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Usuario',
                'data-bind'=>'value: usuario'
             )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Richpolis\UsuariosBundle\Entity\Hijo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'richpolis_usuariosbundle_hijo';
    }
}
