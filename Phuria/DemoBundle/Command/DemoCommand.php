<?php

namespace Phuria\DemoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Phuria\DemoBundle\Entity\DemoInterface;
use Phuria\DemoBundle\Entity\Clinic;
use Phuria\DemoBundle\Entity\Doctor;
use Phuria\DemoBundle\Entity\Procedure;

class DemoCommand extends ContainerAwareCommand
{
    protected $listTables = ['clinic', 'doctors_clinics', 'doctor', 'doctors_procedures', 'procedure_'];
    protected $clinicsNames = ['Tavistock Clinic', 'Suitcase Clinic', 'The Edmonton Clinic', 'The Shyness Clinic', 'Mayo Clinic'];
    protected $doctorsNames = ['Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore'];
    protected $proceduresNames = ['A-Scan Biometry', 'Bone Scan', 'Fluoroscopy', 'Lymphoscintigraphy', 'Mammogram', 'Pulmonary Angiography'];
    protected $descriptionSample = 'This is sample description for ';
    
    public function configure()
    {
        $this
           ->setName('phuria:generateSampleDatabase')
           ->setDescription('Generate sample database whit');
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->truncateDatabase();
        $this->fillDatabase();
        $this->generateAssociations();
    }
    
    protected function truncateDatabase()
    {
        $entityManager = $this->getContainer()->get('doctrine')->getManager();
        $connection = $entityManager->getConnection();
     
        $connection->executeQuery('SET foreign_key_checks = 0');
        
        foreach ($this->listTables as $table)
        {
            $connection->executeQuery('TRUNCATE TABLE ' . $table );
        }
        
        $connection->executeQuery('SET foreign_key_checks = 1');
    }
    
    protected function fillDatabase()
    {        
        $entityManager = $this->getContainer()->get('doctrine')->getManager();
        
        foreach($this->clinicsNames as $name)
        {
            $clinic = new Clinic();
            $clinic->setName($name)->setDescription($this->descriptionSample . $name);
            $entityManager->persist($clinic);
        }
        
        foreach($this->doctorsNames as $name)
        {
            $doctor = new Doctor();
            $doctor->setName($name)->setDescription($this->descriptionSample . $name);
            $entityManager->persist($doctor);
        }
        
        foreach($this->proceduresNames as $name)
        {
            $procedure = new Procedure();
            $procedure->setName($name)->setDescription($this->descriptionSample . $name);
            $entityManager->persist($procedure);
        }
        
        $entityManager->flush();
    }
    
    protected function generateAssociations()
    {
        $entityManager = $this->getContainer()->get('doctrine')->getManager();
        $clinics = $entityManager->getRepository('PhuriaDemoBundle:Clinic')->findAll();
        $doctors = $entityManager->getRepository('PhuriaDemoBundle:Doctor')->findAll();
        $procedures = $entityManager->getRepository('PhuriaDemoBundle:Procedure')->findAll();
        
        foreach($clinics as $clinic)
        {
            foreach($doctors as $doctor)
            {
                if($this->coinToss())
                {
                    $doctor->addClinic($clinic);
                }
            }
        }
        
        foreach($doctors as $doctor)
        {
            foreach($procedures as $procedure)
            {
                if($this->coinToss())
                {
                    $doctor->addProcedure($procedure);
                }
            }
        }
        
        $entityManager->flush();
    }
    
    protected function coinToss()
    {
        return (bool) rand(0, 1);
    }
}

?>
