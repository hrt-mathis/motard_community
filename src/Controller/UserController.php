<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
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
    * @Route("/user") 
    */
class UserController extends AbstractController
{
    /**
    * @Route("/", name="user_index") 
    */  
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findAll();
        return $this->render('user/index.html.twig', array("user" => $user));
    }

    /**
    * @Route("/view/{id}", name="user_view")
    */
    public function view(User $user)
    {
        return $this->render('user/view.html.twig' , ['user' => $user]);
    } 

    /**
    * @Route("/add", name="user_add")
    */
    public function add(Request $request)
    {    
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_view', ['id' => $user->getId()]);
        }  
        return $this->render('User/add.html.twig', ['form' => $form->createView()]);  
    } 

    /**
    * @Route("/edit/{id}", name="user_edit")
    */
    public function edit(Request $request, User $user)
    {
        
        $form = $this->createForm(UserType::class, $user);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('user_view', ['id' => $user->getId()]);
            }}
        return $this->render('User/edit.html.twig', ['form' => $form->createView()]);  
    }


    /**
    * @Route("/delete/{id}", name="user_delete")
    */
    public function delete(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        
        return $this->redirectToRoute('user_index');
    } 
}
?>