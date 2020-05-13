<?php
namespace App\Controller;
use App\Entity\Rides;
use App\Form\RidesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


    /**
    * @Route("/rides")
    */
class RidesController extends AbstractController
    {
    /**
     * @Route("/", name="rides_index") 
     */  
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Rides::class);
        $rides = $repository->findAll();
        return $this->render('rides/index.html.twig', array("rides" => $rides));
    }


    /**
     * @Route("/view/{id}", name="rides_view")
     */
    public function view(Rides $rides)
    {
        return $this->render('rides/view.html.twig' , ['rides' => $rides]);
    } 


    /**
     * @Route("/add", name="rides_add")
     */
    public function add(Request $request)
    {    
        $rides = new Rides();

        $form = $this->createForm(RidesType::class, $rides);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rides);
            $em->flush();

            return $this->redirectToRoute('rides_view', ['id' => $rides->getId()]);
        }
        return $this->render('Rides/add.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/edit/{id}", name="rides_edit")
     */
    public function edit(Request $request, Rides $rides)
    {
        $form = $this->createForm(RidesType::class, $rides);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($rides);
                $em->flush();

                return $this->redirectToRoute('rides_view', ['id' => $rides->getId()]);
            }}
        return $this->render('Rides/edit.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/delete/{id}", name="rides_delete")
     */
    public function delete(Rides $rides)
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($rides);
        $em->flush();
        
        return $this->redirectToRoute('rides_index');
    } 
    
    }

?>