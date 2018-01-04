<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.12.17
 * Time: 14:27
 */

namespace EntasisBundle\Controller\Admin;


use Doctrine\ORM\EntityManagerInterface;
use EntasisBundle\Entity\Category;
use EntasisBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package EntasisBundle\Controller\Admin
 * @Route("/admin")
 */
class CategoryController extends Controller
{
    private $repository;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository('EntasisBundle:Category');
        $this->em = $em;
    }

    /**
     * @Route("/", name="category_list")
     */
    public function categoryListAction()
    {
        $categories = $this->repository->findAll();

        return $this->render('@Entasis/admin/categories/categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @param Request $request
     * @Route("/add-category", name="add_category")
     * @return Response
     */
    public function addCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($category);
            $this->em->flush();

            return $this->redirectToRoute('category_list');
        }

        return $this->render('@Entasis/admin/categories/add_category.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @Route("/edit-category/{id}", name="edit_category")
     * @return Response
     */
    public function editCategoryAction($id, Request $request)
    {
        $category = $this->repository->find($id);
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($category);
            $this->em->flush();

            return $this->redirectToRoute('category_list');
        }

        return $this->render('@Entasis/admin/categories/edit_category.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @Route("/remove-category/{id}", name="remove_category")
     * @return Response
     */
    public function removeCategory($id)
    {
        $category = $this->repository->find($id);
        $this->em->remove($category);
        $this->em->flush();

        return $this->redirectToRoute('category_list');
    }
}