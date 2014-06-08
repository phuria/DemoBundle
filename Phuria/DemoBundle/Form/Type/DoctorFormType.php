<?php
namespace Phuria\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DoctorFormType extends AbstractType
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder->add('id', 'number', array(
            'label' => 'ID',
            'disabled' => true
        ));
        $builder->add('name', 'text', array(
            'label' => 'Name',
            'required' => false
        ));
        $builder->add('description', 'text', array(
            'label' => 'Description',
            'required' => false
        ));
        $builder->add('procedures', 'select2', array(
            'class' => 'Phuria\DemoBundle\Entity\Procedure',
            'property' => 'id',
            'repository' => 'PhuriaDemoBundle:Procedure',
            'label' => 'Procedures',
            'required' => false
        ));
        $builder->add('clinics', 'collection', array(
            'type' => new ClinicType(),
            'label' => 'Clinics',
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'by_reference' => false,
            'required' => false,
            'options' => array(
                'required' => false,
                'attr' => array('class' => 'clinic-box'),
                'label_attr' => array('class' => 'clinic-label')
            )
        ));
        $builder->add('Save', 'submit', array(
            'attr' => array('class' => 'btn btn-primary btn-lg submit')
        ));
    }
    
    public function getName()
    {
        return 'doctorForm';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Phuria\DemoBundle\Entity\Doctor',
        ));
    }
}

?>
