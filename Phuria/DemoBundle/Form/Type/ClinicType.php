<?php
namespace Phuria\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClinicType extends AbstractType
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
           'attr' => array('class' => 'clinic-id')
        ));
        $builder->add('name', 'hidden', array(
           'attr' => array('class' => 'clinic-name')
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