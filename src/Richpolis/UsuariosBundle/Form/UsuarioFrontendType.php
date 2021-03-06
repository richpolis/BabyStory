<?php

namespace Richpolis\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Richpolis\UsuariosBundle\Entity\Usuario;

class UsuarioFrontendType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                
        $builder
            ->add('username','text',array('label'=>'Usuario','attr'=>array(
                'class'=>'validate[required] form-control placeholder',
                'placeholder'=>'Usuario',
                'data-bind'=>'value: usuario'
             )))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'first_options'   => array('label' => 'Contraseña'),
                'second_options'  => array('label' => 'Repite Contraseña'),
                'required'        => false,
                'options' => array(
                    'attr'=>array('class'=>'form-control placeholder')
                )
            ))    
            ->add('email','email',array('label'=>'Email','attr'=>array(
                'class'=>'validate[required] form-control placeholder',
                'placeholder'=>'Email',
                'data-bind'=>'value: email'
             )))
            ->add('file','file',array('label'=>'Imagen',
                'required'=>false,
                'attr'=>array(
                    'class'=>'form-control placeholder',
                    'placeholder'=>'Imagen usuario',
                    'data-bind'=>'value: imagen usuario'
             )))    
            ->add('ciudad','text',array('label'=>'Ciudad','attr'=>array(
                'class'=>'validate[required] form-control placeholder',
                'placeholder'=>'Ciudad',
                'data-bind'=>'value: ciudad'
             )))
            ->add('sexo','choice',array(
                'label'=>'Es',
                'empty_value'=>false,
                'read_only'=> true,
                'choices'=>  Usuario::getArraySexo(),
                'preferred_choices'=>  Usuario::getPreferedSexo(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Es',
                    'data-bind'=>'value: es'
                )))    
            ->add('biografia',null,array('label'=>'Biografia','attr'=>array(
                'class'=>'validate[required] form-control placeholder',
                'placeholder'=>'Biografia',
                'data-bind'=>'value: biografia'
             )))
            ->add('serMadre',null,array('label'=>'Ser padre/madre','attr'=>array(
                'class'=>'validate[required] form-control placeholder',
                'placeholder'=>'Ser padre/madre',
                'data-bind'=>'value: sermadre'
             )))
            ->add('ninos','text',array('label'=>'Niños',
                'read_only'=>true,
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'0',
                    'data-bind'=>'value: ninos'
             )))
            ->add('ninas','text',array('label'=>'Niñas',
                'read_only'=>true,
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'0',
                    'data-bind'=>'value: ninas'
             )))  
            ->add('salt','hidden')
            ->add('imagen','hidden')
            ->add('isActive','hidden')
            ->add('link','hidden')    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Richpolis\UsuariosBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
