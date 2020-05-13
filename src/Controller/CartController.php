<?php
namespace App\Controller;
use App\Entity\Cart;
use App\Form\CartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


    /**
    * @Route("/cart")
    */
class CartController extends AbstractController
    {
        /**
     * @Route("/", name="cart_index") 
     */  
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Cart::class);
        $cart = $repository->findAll();
        return $this->render('cart/index.html.twig', array("cart" => $cart));
    }


    /**
     * @Route("/view/{id}", name="cart_view")
     */
    public function view(Cart $cart)
    {
        return $this->render('cart/view.html.twig' , ['cart' => $cart]);
    } 


    /**
     * @Route("/add", name="cart_add")
     */
    public function add(Request $request)
    {    
        $cart = new Cart();

        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cart);
            $em->flush();

            return $this->redirectToRoute('cart_view', ['id' => $cart->getId()]);
        }
        return $this->render('Cart/add.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/edit/{id}", name="cart_edit")
     */
    public function edit(Request $request, Cart $cart)
    {
        $form = $this->createForm(CartType::class, $cart);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cart);
                $em->flush();

                return $this->redirectToRoute('cart_view', ['id' => $cart->getId()]);
            }}
        return $this->render('Cart/edit.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/delete/{id}", name="cart_delete")
     */
    public function delete(Cart $cart)
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($cart);
        $em->flush();
        
        return $this->redirectToRoute('cart_index');
    } 
        
    }
?>