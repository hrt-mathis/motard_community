<?php
namespace App\Controller;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


    /**
    * @Route("/product")
    */
class ProductController extends AbstractController
    {
    /**
    * @Route("/", name="product_index") 
    */  
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $product = $repository->findAll();
        return $this->render('product/index.html.twig', array("product" => $product));
    }


    /**
     * @Route("/view/{id}", name="product_view")
     */
    public function view(Product $product)
    {
        return $this->render('product/view.html.twig' , ['product' => $product]);
    } 


    /**
     * @Route("/add", name="product_add")
     */
    public function add(Request $request)
    {    
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_view', ['id' => $product->getId()]);
        }
        return $this->render('Product/add.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/edit/{id}", name="product_edit")
     */
    public function edit(Request $request, Product $product)
    {
        $form = $this->createForm(ProductType::class, $product);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();

                return $this->redirectToRoute('product_view', ['id' => $product->getId()]);
            }}
        return $this->render('Product/edit.html.twig', ['form' => $form->createView()]);  
    } 


    /**
     * @Route("/delete/{id}", name="product_delete")
     */
    public function delete(Product $product)
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        
        return $this->redirectToRoute('product_index');
    } 
    
    }

?>