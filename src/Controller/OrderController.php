<?php
namespace App\Controller;
use App\Entity\Order;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


    /**
    * @Route("/order")
    */
class OrderController extends AbstractController
    {
        /**
     * @Route("/", name="order_index") 
     */  
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Order::class);
        $order = $repository->findAll();
        return $this->render('order/index.html.twig', array("order" => $order));
    }


    /**
     * @Route("/view/{id}", name="order_view")
     */
    public function view(Order $order)
    {
        return $this->render('order/view.html.twig' , ['order' => $order]);
    } 


    /**
     * @Route("/add", name="order_add")
     */
    public function add(Request $request)
    {    
        $order = new Order();

        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();

            return $this->redirectToRoute('order_view', ['id' => $order->getId()]);
        }
        return $this->render('Order/add.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/edit/{id}", name="order_edit")
     */
    public function edit(Request $request, Order $order)
    {
        $form = $this->createForm(OrderType::class, $order);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($order);
                $em->flush();

                return $this->redirectToRoute('order_view', ['id' => $order->getId()]);
            }}
        return $this->render('Order/edit.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/delete/{id}", name="order_delete")
     */
    public function delete(Order $order)
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($order);
        $em->flush();
        
        return $this->redirectToRoute('order_index');
    } 
    
    }

?>