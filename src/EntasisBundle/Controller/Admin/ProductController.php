<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.12.17
 * Time: 15:18
 */

namespace EntasisBundle\Controller\Admin;


use Doctrine\ORM\EntityManagerInterface;
use EntasisBundle\Entity\Product;
use EntasisBundle\Form\ProductType;
use EntasisBundle\Form\ProductUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package EntasisBundle\Controller\Admin
 * @Route("/admin")
 */
class ProductController extends Controller
{
    private $repository;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository('EntasisBundle:Product');
        $this->em = $em;
    }

    /**
     * @Route("/products", name="product_list")
     */
    public function productListAction()
    {
        $products = $this->repository->findAll();

        return $this->render('@Entasis/admin/products/products.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @param Request $request
     * @Route("/add-product", name="add_product")
     * @return Response
     */
    public function add_productAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($product);
            $this->em->flush();

            return $this->redirectToRoute('product_list');
        }

        return $this->render('@Entasis/admin/products/add_product.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @Route("/edit-product/{id}", name="edit_product")
     * @return Response
     */
    public function editProductAction($id, Request $request)
    {
        $product = $this->repository->findForUpdate($id);
        $form = $this->createForm(ProductUpdateType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($product);
            $this->em->flush();

            return $this->redirectToRoute('product_list');
        }

        return $this->render('@Entasis/admin/products/edit_product.html.twig', [
            'form' => $form->createView(),
            'product' => $product
        ]);
    }

    /**
     * @param $id
     * @Route("/remove-product/{id}", name="remove_product")
     * @return Response
     */
    public function removeProductAction($id)
    {
        $product = $this->repository->find($id);
        $this->em->remove($product);
        $this->em->flush();

        return $this->redirectToRoute('product_list');
    }
}