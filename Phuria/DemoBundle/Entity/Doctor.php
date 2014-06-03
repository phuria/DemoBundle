<?php
namespace Phuria\DemoBundle\Entity;

class Doctor implements DemoInterface
{
    protected $id;
    protected $name;
    protected $description;
    protected $clinics;
    protected $procedures;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clinics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->procedures = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Doctor
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
     * @return Doctor
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
     * Add clinics
     *
     * @param \Phuria\DemoBundle\Entity\Clinic $clinics
     * @return Doctor
     */
    public function addClinic(\Phuria\DemoBundle\Entity\Clinic $clinics)
    {
        $this->clinics[] = $clinics;

        return $this;
    }

    /**
     * Remove clinics
     *
     * @param \Phuria\DemoBundle\Entity\Clinic $clinics
     */
    public function removeClinic(\Phuria\DemoBundle\Entity\Clinic $clinics)
    {
        $this->clinics->removeElement($clinics);
    }

    /**
     * Get clinics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClinics()
    {
        return $this->clinics;
    }
    
    public function clearClinics()
    {
        $this->clinics->clear();
        return $this;
    }

    /**
     * Add procedures
     *
     * @param \Phuria\DemoBundle\Entity\Procedure $procedures
     * @return Doctor
     */
    public function addProcedure(\Phuria\DemoBundle\Entity\Procedure $procedures)
    {
        $this->procedures[] = $procedures;

        return $this;
    }

    /**
     * Remove procedures
     *
     * @param \Phuria\DemoBundle\Entity\Procedure $procedures
     */
    public function removeProcedure(\Phuria\DemoBundle\Entity\Procedure $procedures)
    {
        $this->procedures->removeElement($procedures);
    }

    /**
     * Get procedures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProcedures()
    {
        return $this->procedures;
    }
    
    public function clearProcedures()
    {
        $this->procedures->clear();
        return $this;
    }
}
