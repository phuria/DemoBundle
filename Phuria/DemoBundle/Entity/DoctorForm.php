<?php
namespace Phuria\DemoBundle\Entity;

class DoctorForm
{
    protected $doctorId;
    protected $doctorName;
    protected $doctorDescription;
    protected $doctorProceduresValue;
    protected $doctorCurrentClinics;
    protected $doctorAvailableClinics;
    
    public function setDoctorId($id)
    {
        $this->doctorId = $id;
        return $this;
    }
    
    public function getDoctorId()
    {
        return $this->doctorId;
    }
    
    public function setDoctorName($name)
    {
        $this->doctorName = $name;
        return $this;
    }
    
    public function getDoctorName()
    {
        return $this->doctorName;
    }
    
    public function setDoctorDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    public function getDoctorDescription()
    {
        return $this->description;
    }
    
    public function setDoctorProceduresValue($value)
    {
        $this->doctorProceduresValue = $value;
        return $this;
    } 
    
    public function getDoctorProceduresValue()
    {
        return $this->doctorProceduresValue;
    }
    
    public function setDoctorCurrentClinics($clinics)
    {
        $this->doctorCurrentClinics = $clinics;
        return $this;
    } 
    
    public function getDoctorCurrentClinics()
    {
        return $this->doctorCurrentClinics;
    }
    
    public function setDoctorAvailableClinics($clinics)
    {
        $this->doctorAvailableClinics = $clinics;
        return $this;
    } 
    
    public function getDoctorAvailableClinics()
    {
        return $this->doctorAvailableClinics;
    }
    
}

?>
