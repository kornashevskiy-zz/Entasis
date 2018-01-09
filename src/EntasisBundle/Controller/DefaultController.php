<?php

namespace EntasisBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use EntasisBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    const RUSSIAN_ZONE = 'ru';
    const ENGLISH_ZONE = 'en';
    const RU_FLASH = 'Ваше сообщение успешно отправлено';
    const EN_FLASH = 'The message has been successfully sent';
    private $repository;
    private $categories;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository('EntasisBundle:Product');
        $this->categories = $em->getRepository('EntasisBundle:Category')
            ->findAll();
    }

    /**
     * @param $request
     * @Route("/", name="homepage")
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $this->repository->findAll(),
            $request->query->getInt('page', 1)/*page number*/,
            10
        );

        $location = $request->getLocale();

        return $this->render('@Entasis/'.$location.'/site/index.html.twig', [
            'pagination' => $pagination,
            'categories' => $this->categories,
            'page' => $request->get('page')
        ]);
    }

    /**
     * @param $category
     * @param Request $request
     * @return Response
     * @Route("/{category}", name="product_by_category")
     */
    public function productByCategoryAction($category, Request $request)
    {
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $this->repository->findProductsByCategory($category),
            $request->query->getInt('page', 1)/*page number*/,
            10
        );

        $location = $request->getLocale();

        return $this->render('@Entasis/'.$location.'/site/product_by_category.html.twig', [
            'categories' => $this->categories,
            'pagination' => $pagination,
            'page' => $request->get('page'),
            'category' => $category
        ]);
    }

    /**
     * @param $id
     * @param $request
     * @return Response
     * @Route("/product/{id}", name="view_product")
     */
    public function viewProductAction($id, Request $request)
    {
        $product = $this->repository->find($id);
        $location = $request->getLocale();

        return $this->render('@Entasis/'.$location.'/site/view_product.html.twig', [
            'categories' => $this->categories,
            'product' => $product
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/contact", name="contact")
     */
    public function contactPageAction(Request $request)
    {
        $location = $request->getLocale();
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($this->get('contact.mailer')->send($form)) {
                $location == 'ru' ?
                    $this->addFlash('success', self::RU_FLASH) :
                    $this->addFlash('success', self::EN_FLASH);
            }

            return $this->render('@Entasis/'.$location.'/site/contact.html.twig', [
                'categories' => $this->categories,
                'form' => $form->createView()
            ]);
        }

        return $this->render('@Entasis/'.$location.'/site/contact.html.twig', [
            'categories' => $this->categories,
            'form' => $form->createView()
        ]);
    }
}
