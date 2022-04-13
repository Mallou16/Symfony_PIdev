<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
//use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MaterielController extends AbstractController
{
    /**
     * @Route("/materiel", name="app_materiel")
     */
    public function index(): Response
    {
        return $this->render('materiel/home.html.twig', [
            'controller_name' => 'MaterielController',
        ]);
    }

    /**
     * @param MaterielRepository $repository
     * @return Response
     * @Route("/ReadMateriel",name="Read")
     */

    public function ReadMateriel(MaterielRepository $repository)
    {
        //$rep=$this->getDoctrine()->getRepository(Materiel::class);
        $Materiel=$repository->findAll();
        return $this->render('materiel/read.html.twig',
        ['materiel'=>$Materiel]);
    }

    /**
     * @Route("/DeleteMateriel/{id}",name="delete")
     */
    public function DeleteMateriel(MaterielRepository $repository , $id){
        $Materiel=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Materiel);
        $em->flush();
        return $this->redirectToRoute('Read');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddMateriel",name="add")
     */
    public function AddMateriel(Request $request){
        $materiel=new Materiel();
        $form=$this->createForm(MaterielType::class,$materiel);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();
            return $this->redirectToRoute('Read');
        }
        return $this->render('materiel/add.materiel.twig',[
           'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/UpdateMateriel/{id}",name="update")
     */
    public function UpdateMateriel(MaterielRepository $repository , Request $request, $id){
        $materiel=$repository->find($id);
        $form=$this->createForm(MaterielType::class,$materiel);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('Read');
        }
        return $this->render('materiel/update.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/materielfront", name="app_materiel")
     */
    public function indexMateriel(): Response
    {
        return $this->render('materiel/fronthome.html.twig', [
            'controller_name' => 'MaterielController',
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/AddMaterielFront",name="addfront")
     */
    public function AddMaterielFront(Request $request){
        $materiel=new Materiel();
        $form=$this->createForm(MaterielType::class,$materiel);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();
            return $this->redirectToRoute('ReadF');
        }
        return $this->render('materiel/addfront.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @param MaterielRepository $repository
     * @return Response
     * @Route("/ReadMaterielFront",name="ReadF")
     */
    public function ReadMaterielFront(MaterielRepository $repository)
    {
        //$rep=$this->getDoctrine()->getRepository(Materiel::class);
        $Materiel=$repository->findAll();
        return $this->render('materiel/readfront.html.twig',
            ['materiel'=>$Materiel]);
    }

    /**
     * @Route("/DeleteMateriel/{id}",name="deletefront")
     */
    public function DeleteMaterielFront(MaterielRepository $repository , $id){
        $Materiel=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Materiel);
        $em->flush();
        return $this->redirectToRoute('ReadF');
    }

    /**
     * @Route("/UpdateMaterielFront/{id}",name="updatefront")
     */
    public function UpdateMaterielFront(MaterielRepository $repository , Request $request, $id){
        $materiel=$repository->find($id);
        $form=$this->createForm(MaterielType::class,$materiel);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('ReadF');
        }
        return $this->render('materiel/updatefront.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
