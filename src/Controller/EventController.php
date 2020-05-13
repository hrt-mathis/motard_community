<?php
namespace App\Controller;
use App\Entity\Event;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


    /**
    * @Route("/event")
    */
class EventController extends AbstractController
    {
        /**
     * @Route("/", name="event_index") 
     */  
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $event = $repository->findAll();
        return $this->render('event/index.html.twig', array("event" => $event));
    }


    /**
     * @Route("/view/{id}", name="event_view")
     */
    public function view(Event $event)
    {
        return $this->render('event/view.html.twig' , ['event' => $event]);
    } 


    /**
     * @Route("/add", name="event_add")
     */
    public function add(Request $request)
    {    
        $event = new Event();

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_view', ['id' => $event->getId()]);
        }
        return $this->render('Event/add.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/edit/{id}", name="event_edit")
     */
    public function edit(Request $request, Event $event)
    {
        $form = $this->createForm(EventType::class, $event);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();

                return $this->redirectToRoute('event_view', ['id' => $event->getId()]);
            }}
        return $this->render('Event/edit.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/delete/{id}", name="event_delete")
     */
    public function delete(Event $event)
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        
        return $this->redirectToRoute('event_index');
    } 
    
    }

?>