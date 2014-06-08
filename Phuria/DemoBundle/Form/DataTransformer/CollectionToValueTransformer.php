<?php
namespace Phuria\DemoBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class CollectionToValueTransformer implements DataTransformerInterface
{
    protected $objectManager;
    protected $repository;
    protected $property;

    public function __construct(ObjectManager $om, $repository, $property)
    {
        $this->objectManager = $om;
        $this->repository = $repository;
        $this->property = $property;
    }

    public function transform($collection)
    {        
        if(null == $collection || $collection->isEmpty())
        {
            return "";
        }
        
        $objects = $collection->toArray();
        $values = array();
        
        foreach($objects as $object)
        {
            $values[] = $object->getId();
        }
        
        return implode(',', $values);
    }

    public function reverseTransform($value)
    {
        $in = explode(',', $value);
        $objects = $this->objectManager->getRepository($this->repository)->findIn($in);
        return new ArrayCollection($objects);
    }

}

?>
