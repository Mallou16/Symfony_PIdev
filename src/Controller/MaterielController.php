<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Entity\Panierencours;
use App\Entity\Search;
use App\Form\MaterielType;
use App\Form\PanierEnCoursType;
use App\Form\SearchType;
use App\Repository\MaterielRepository;
use phpDocumentor\Reflection\Types\Null_;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;

class MaterielController extends AbstractController
{
    /**
     * @Route("/materiel", name="app_materiel")
     */
    public function index(): Response
    {
        return $this->render('materiel/readfront.html.twig', [
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
    public function AddMateriel(Request $request ){
        $materiel=new Materiel();
        $form=$this->createForm(MaterielType::class,$materiel);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $file = $materiel->getImage();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $materiel->setImage($fileName);

            $em=$this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();
            return $this->redirectToRoute('Read');
        }
        return $this->render('materiel/add.html.twig',[
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
            $file = $materiel->getImage();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $materiel->setImage($fileName);
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
            $file = $materiel->getImage();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $materiel->setImage($fileName);
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
        $Panierencours=new Panierencours();
        $Search = new Search();
        $form1=$this->createForm(SearchType::class,$Search);
        $form1->add('Search',SubmitType::class);
        $form=$this->createForm(PanierEnCoursType::class,$Panierencours);
        $form->add('Confirm',SubmitType::class);
        $Materiel=$repository->findAll();
        return $this->render('materiel/readfront.html.twig',
            ['materiel'=>$Materiel,
                'f'=>$form->createView(),
                'form'=>$form1->createView()
            ]);
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
            $file = $materiel->getImage();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $materiel->setImage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('ReadF');
        }
        return $this->render('materiel/updatefront.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @param MaterielRepository $repository
     * @param Request $request
     * @return Response
     * @Route("/SearchMateriel",name="search")
     */
    public function Search(MaterielRepository $repository ,Request $request)
    {
        $search_array=array();
        $Panierencours=new Panierencours();
        $Search = new Search();
        $form1=$this->createForm(SearchType::class,$Search);
        $form1->add('Search',SubmitType::class);
        $form=$this->createForm(PanierEnCoursType::class,$Panierencours);
        $form->add('Confirm',SubmitType::class );
        $form1->submit($request->request->get($form1->getName()));
        if ($Search->getNom()!= null){
            $search_array['nom']=$Search->getNom();
        }
        if ($Search->getPrix()!= null){
            $search_array['prix']=floatval($Search->getPrix());
        }
        if ($Search->getQuantite()!= null){
            $search_array['quantite']=intval($Search->getQuantite());
        }
        if ($form1->isSubmitted() && $form1->isValid()){
            $Materiel=$repository->findBy($search_array);
            return $this->render('materiel/readfront.html.twig',
                ['materiel'=>$Materiel,
                    'f'=>$form->createView(),
                    'form'=>$form1->createView()
                ]);
        }
    }

    /**
     * @param MaterielRepository $repository
     * @return Response
     * @Route("/Triermaterielnom",name="trinom")
     */
    public function TrierMaterielNom(MaterielRepository $repository){
        $materiel = $repository->findByNom();
        $Panierencours=new Panierencours();
        $Search = new Search();
        $form1=$this->createForm(SearchType::class,$Search);
        $form1->add('Search',SubmitType::class);
        $form=$this->createForm(PanierEnCoursType::class,$Panierencours);
        $form->add('Confirm',SubmitType::class);
        return $this->render('materiel/readfront.html.twig',
            ['materiel'=>$materiel,
                'f'=>$form->createView(),
                'form'=>$form1->createView()
            ]);
    }

    /**
     * @param MaterielRepository $repository
     * @return Response
     * @Route("/Triermaterielprix",name="triprix")
     */
    public function TrierMaterielPrix(MaterielRepository $repository){
        $materiel = $repository->findByPrix();
        $Panierencours=new Panierencours();
        $Search = new Search();
        $form1=$this->createForm(SearchType::class,$Search);
        $form1->add('Search',SubmitType::class);
        $form=$this->createForm(PanierEnCoursType::class,$Panierencours);
        $form->add('Confirm',SubmitType::class);
        return $this->render('materiel/readfront.html.twig',
            ['materiel'=>$materiel,
                'f'=>$form->createView(),
                'form'=>$form1->createView()
            ]);
    }

    /**
     * @param MaterielRepository $repository
     * @return Response
     * @Route("/Triermaterielquantite",name="triquantite")
     */
    public function TrierMaterielQuantite(MaterielRepository $repository){
        $materiel = $repository->findByQuantite();
        $Panierencours=new Panierencours();
        $Search = new Search();
        $form1=$this->createForm(SearchType::class,$Search);
        $form1->add('Search',SubmitType::class);
        $form=$this->createForm(PanierEnCoursType::class,$Panierencours);
        $form->add('Confirm',SubmitType::class);
        return $this->render('materiel/readfront.html.twig',
            ['materiel'=>$materiel,
                'f'=>$form->createView(),
                'form'=>$form1->createView()
            ]);
    }

    /**
     * @param $image
     * @param $description
     * @return Response
     * @Route("/ShowArticle/{image}/{description}",name="showarticle")
     */
    public function ShowArticle($image , $description){
        $img = "/assets/frontend/dist/img/".$image;
        return $this->render('materiel/image.html.twig',[
          'image' => $img  , 'description' => $description
        ]);
    }
}
