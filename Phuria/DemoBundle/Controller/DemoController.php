<?php
namespace Phuria\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Phuria\DemoBundle\Entity\DoctorForm;
use Phuria\DemoBundle\Entity\Doctor;
use Phuria\DemoBundle\Entity\Clinic;
use Phuria\DemoBundle\Form\Type\DoctorFormType;

class DemoController extends Controller
{
    public function indexAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $doctors = $entityManager->getRepository('PhuriaDemoBundle:Doctor')->findAll();
        $doctorForm = new DoctorForm();
        
        if($id == 0)
        {
            $actionDoctor = new Doctor();
        }
        else
        {
            $actionDoctor = $entityManager->getRepository('PhuriaDemoBundle:Doctor')->find($id);
        }
        
        $proceduresValue = $this->getCollectionValue($actionDoctor->getProcedures());
        $availableClinics = $entityManager->getRepository('PhuriaDemoBundle:Clinic')->findAll();
        
        $doctorForm
           ->setDoctorId($actionDoctor->getId())
           ->setDoctorName($actionDoctor->getName())
           ->setDoctorDescription($actionDoctor->getDescription())
           ->setDoctorProceduresValue($proceduresValue)
           ->setDoctorCurrentClinics($actionDoctor->getClinics())
           ->setDoctorAvailableClinics($availableClinics);
        
        $form = $this->createForm(new DoctorFormType(), $doctorForm);
        
        $form->handleRequest($request);
        
        if($form->isValid()) 
        {
            $data = $form->getData();
            
            if($data->getDoctorId() == 0)
            {
                $doctor = new Doctor();
                $entityManager->persist($doctor);
            }
            else
            {
                $doctor = $entityManager->getRepository('PhuriaDemoBundle:Doctor')->find($data->getDoctorId());
            }
            
            $procedures = $entityManager->getRepository('PhuriaDemoBundle:Procedure')->findAll();
            $clinics = $entityManager->getRepository('PhuriaDemoBundle:Clinic')->findAll();
            
            if($data->getDoctorProceduresValue())
            {
                $value = $data->getDoctorProceduresValue();
                $proceduresSelected = explode(",", $value);
            }
            else
            {
                $proceduresSelected = array();
            }
            
            $clinicsSelected = $data->getDoctorCurrentClinics()->toArray();
            
            $doctor
               ->setName($data->getDoctorName())
               ->setDescription($data->getDoctorDescription())
               ->clearProcedures()
               ->clearClinics();
                        
            foreach($proceduresSelected as $id)
            {
                foreach($procedures as $procedure)
                {
                    if($procedure->getId() == $id)
                    {
                        $doctor->addProcedure($procedure);
                        break;
                    }
                }
            }
            
            foreach($clinicsSelected as $selectedClinic)
            {
                foreach($clinics as $clinic)
                {
                    if($clinic->getId() == $selectedClinic->getId())
                    {
                        $doctor->addClinic($clinic);
                    }
                }
            }
            
            $entityManager->flush();
            
        }
        

        return $this->render('PhuriaDemoBundle:Demo:index.html.twig', array(
            'doctors' => $doctors, 
            'form' => $form->createView()
        ));
    }

    
    public function proceduresAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $procedures = $entityManager->getRepository('PhuriaDemoBundle:Procedure')->findAll();
        $response = new JsonResponse();
        $data = array();
        
        foreach($procedures as $procedure)
        {
            $data[] = array('id' => $procedure->getId(), 'text' => $procedure->getName());
        }
        
        $response->setData($data);
        return $response;
    }
    
    protected function getCollectionValue($collection)
    {
        $values = array();
        
        foreach($collection->toArray() as $element)
        {
            $values[] = $element->getId();
        }
        
        return implode($values, ',');
    }
    
}
