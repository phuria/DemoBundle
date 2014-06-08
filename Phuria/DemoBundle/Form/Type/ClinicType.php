<?php
namespace Phuria\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClinicType extends AbstractType
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'text', array(
           'attr' => array('class' => 'clinic-id'),
           'label_attr' => array('class' => 'sub-label'),
           'disabled' => true
        ));
        $builder->add('name', 'text', array(
           'attr' => array('class' => 'clinic-name'),
           'label_attr' => array('class' => 'sub-label'),
        ));
        $builder->add('description', 'text', array(
           'attr' => array('class' => 'clinic-description'),
           'label_attr' => array('class' => 'sub-label'),
        ));
    }
    
    public function getName()
    {
        return 'clinic';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Phuria\DemoBundle\Entity\Clinic',
        ));
    }
}

?>