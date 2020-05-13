<?php
namespace App\Controller;
use App\Entity\Tutorial;
use App\Form\TutorialType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


    /**
    * @Route("/tutorial")
    */
class TutorialController extends AbstractController
    {
        /**
     * @Route("/", name="tutorial_index") 
     */  
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Tutorial::class);
        $tutorial = $repository->findAll();
        return $this->render('tutorial/index.html.twig', array("tutorial" => $tutorial));
    }


    /**
     * @Route("/view/{id}", name="tutorial_view")
     */
    public function view(Tutorial $tutorial)
    {
        return $this->render('tutorial/view.html.twig' , ['tutorial' => $tutorial]);
    } 


    /**
     * @Route("/add", name="tutorial_add")
     */
    public function add(Request $request)
    {    
        $tutorial = new Tutorial();

        $form = $this->createForm(TutorialType::class, $tutorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tutorial);
            $em->flush();

            return $this->redirectToRoute('tutorial_view', ['id' => $tutorial->getId()]);
        }
        return $this->render('Tutorial/add.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/edit/{id}", name="tutorial_edit")
     */
    public function edit(Request $request, Tutorial $tutorial)
    {
        $form = $this->createForm(TutorialType::class, $tutorial);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tutorial);
                $em->flush();

                return $this->redirectToRoute('tutorial_view', ['id' => $tutorial->getId()]);
            }}
        return $this->render('Tutorial/edit.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/delete/{id}", name="tutorial_delete")
     */
    public function delete(Tutorial $tutorial)
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($tutorial);
        $em->flush();
        
        return $this->redirectToRoute('tutorial_index');
    } 
    
    }

?>