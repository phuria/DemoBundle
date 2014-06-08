<?php
namespace Phuria\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Phuria\DemoBundle\Form\DataTransformer\CollectionToValueTransformer;

class Select2Type extends AbstractType
{
    protected $entityManager;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {     
        $transformer = new CollectionToValueTransformer(
           $this->entityManager, 
           $options['repository'], 
           $options['property']
        );
        $builder->addModelTransformer($transformer);
    }
    
    public function getName()
    {
        return 'select2';
    }
    
    public function getParent()
    {
        return 'text';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'class' => null,
            'property' => null,
            'repository' => null
        ));
    }
}

?>
