<?php
namespace App\Controller;
use App\Entity\Location;
use App\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


    /**
    * @Route("/location")
    */
class LocationController extends AbstractController
    {
        /**
     * @Route("/", name="location_index") 
     */  
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $location = $repository->findAll();
        return $this->render('location/index.html.twig', array("location" => $location));
    }


    /**
     * @Route("/view/{id}", name="location_view")
     */
    public function view(Location $location)
    {
        return $this->render('location/view.html.twig' , ['location' => $location]);
    } 


    /**
     * @Route("/add", name="location_add")
     */
    public function add(Request $request)
    {    
        $location = new Location();

        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();

            return $this->redirectToRoute('location_view', ['id' => $location->getId()]);
        }
        return $this->render('Location/add.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/edit/{id}", name="location_edit")
     */
    public function edit(Request $request, Location $location)
    {
        $form = $this->createForm(LocationType::class, $location);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($location);
                $em->flush();

                return $this->redirectToRoute('location_view', ['id' => $location->getId()]);
            }}
        return $this->render('Location/edit.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/delete/{id}", name="location_delete")
     */
    public function delete(Location $location)
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($location);
        $em->flush();
        
        return $this->redirectToRoute('location_index');
    } 
    
    }

?>