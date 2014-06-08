<?php
namespace Phuria\DemoBundle\Entity;

class Procedure implements DemoInterface
{
    protected $id;
    protected $name;
    protected $description;
    protected $doctors;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->doctors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Procedure
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Procedure
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add doctors
     *
     * @param \Phuria\DemoBundle\Entity\Doctor $doctors
     * @return Procedure
     */
    public function addDoctor(\Phuria\DemoBundle\Entity\Doctor $doctors)
    {
        $this->doctors[] = $doctors;

        return $this;
    }

    /**
     * Remove doctors
     *
     * @param \Phuria\DemoBundle\Entity\Doctor $doctors
     */
    public function removeDoctor(\Phuria\DemoBundle\Entity\Doctor $doctors)
    {
        $this->doctors->removeElement($doctors);
    }

    /**
     * Get doctors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDoctors()
    {
        return $this->doctors;
    }
}
