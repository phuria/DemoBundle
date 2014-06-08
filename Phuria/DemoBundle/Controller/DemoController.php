<?php
namespace Phuria\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Phuria\DemoBundle\Entity\Doctor;
use Phuria\DemoBundle\Entity\Clinic;
use Phuria\DemoBundle\Form\Type\DoctorFormType;

class DemoController extends Controller
{
    public function indexAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $doctors = $entityManager->getRepository('PhuriaDemoBundle:Doctor')->findAll();
        
        if($id == 0)
        {
            $doctor = new Doctor();
        }
        else
        {
            $doctor = $entityManager->getRepository('PhuriaDemoBundle:Doctor')->find($id);
        }
        
        $form = $this->createForm(new DoctorFormType(), $doctor);
        $form->handleRequest($request);
        
        if($form->isValid()) 
        {
            $doctor = $form->getData();
            $entityManager->persist($doctor);
            $entityManager->flush();
        }
        

        return $this->render('PhuriaDemoBundle:Demo:index.html.twig', array(
            'doctors' => $doctors, 
            'form' => $form->createView()
        ));
    }

    public function proceduresAction(Request $request)
    {
        $query = $request->query->get('query');
        $entityManager = $this->getDoctrine()->getManager();
        $procedures = $entityManager->getRepository('PhuriaDemoBundle:Procedure')->findNameLike($query);
        $response = new JsonResponse();
        $data = array();
        
        foreach($procedures as $procedure)
        {
            $data[] = array('id' => $procedure->getId(), 'text' => $procedure->getName());
        }
        
        $response->setData($data);
        return $response;
    }
    
    public function initProceduresAction($doctorId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $doctor = $entityManager->getRepository('PhuriaDemoBundle:Doctor')->find($doctorId);
        $procedures = $doctor->getProcedures()->toArray();
        $response = new JsonResponse();
        
        foreach($procedures as $procedure)
        {
            $data[] = array('id' => $procedure->getId(), 'text' => $procedure->getName());
        }
        
        $response->setData($data);
        return $response;
    }
    
}
