<?php

namespace App\Controller;

use App\Entity\Publicite;
use App\Form\Publicite1Type;
use App\Repository\PubliciteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Publicite/back")
 */
class PubliciteBackController extends AbstractController
{
    /**
     * @Route("/", name="product_back_index", methods={"GET"})
     */
    public function index(PubliciteRepository $productRepository): Response
    {
        return $this->render('product_back/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_back_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $product = new Publicite();
        $form = $this->createForm(Publicite1Type::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_back/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_back_show", methods={"GET"})
     */
    public function show(Publicite $product): Response
    {
        return $this->render('product_back/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_back_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publicite $product): Response
    {
        $form = $this->createForm(Publicite1Type::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_back/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_back_delete", methods={"POST"})
     */
    public function delete(Request $request, Publicite $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
