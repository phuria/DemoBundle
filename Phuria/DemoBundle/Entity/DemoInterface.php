<?php
namespace Phuria\DemoBundle\Entity;

interface DemoInterface
{
    public function getName();
    public function setName($name);
    public function getDescription();
    public function setDescription($description);
}
