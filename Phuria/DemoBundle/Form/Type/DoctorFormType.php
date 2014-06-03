<?php
namespace Phuria\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DoctorFormType extends AbstractType
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('doctorId', 'number', array(
            'label' => 'ID',
            'disabled' => true
        ));
        $builder->add('doctorName', 'text', array(
            'label' => 'Name',
            'required' => false
        ));
        $builder->add('doctorDescription', 'text', array(
            'label' => 'Description',
            'required' => false
        ));
        $builder->add('doctorProceduresValue', 'text', array(
            'label' => 'Procedures',
            'required' => false,
        ));
        $builder->add('doctorCurrentClinics', 'collection', array(
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
        $builder->add('doctorAvailableClinics', 'collection', array(
            'type' => new ClinicType(),
            'label' => 'Available clinics',
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
            'data_class' => 'Phuria\DemoBundle\Entity\DoctorForm',
        ));
    }
}

?>
