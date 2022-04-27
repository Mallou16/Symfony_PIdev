<?php

namespace App\Controller;
use App\Entity\Historique;
use App\Entity\Panierencours;
use App\Repository\HistoriqueRepository;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use App\Entity\Materiel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Search;
use App\Form\PanierEnCoursType;
use App\Form\SearchType;
use App\Repository\MaterielRepository;
use App\Repository\PanierencoursRepository;
use App\Repository\PanierRepository;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;

class PanierencoursController extends AbstractController
{

    /**
     * @Route("/panierencours", name="app_panierencours")
     */
    public function index(): Response
    {
        return $this->render('panierencours/index.html.twig', [
            'controller_name' => 'PanierencoursController',
        ]);
    }

    /**
     * @param PanierRepository $repository
     * @param PanierencoursRepository $rep
     * @return Response
     * @Route("/ReadPEC",name="ReadPEC")
     */

    public function ReadPanierencours(PanierRepository $repository , PanierencoursRepository $rep)
    {
        //$rep=$this->getDoctrine()->getRepository(Materiel::class);
        $Panier=$repository->findBy(array('idPanier' => 1));
        $Panierencours=$rep->findBy(array('idPanier' => 1));
        foreach ($Panier as $row) {
            $Materiel = $row->getIdMateriel();
        }
        $pm=array();
        $somme=0;
        foreach ($Panierencours as $row)
        {
            foreach ($Materiel as $row1)
            {
                if ($row->getIdMateriel()==$row1->getIdMateriel()){
                    $pm1=array(
                        'id' => $row->getIdMateriel(),
                        'nom' => $row1->getNom(),
                        'quantiteP' => $row->getQuantiteP(),
                        'prixU' => $row1->getPrix(),
                        'prixTotale' => $row->getQuantiteP()*$row1->getPrix()
                    );
                    $somme+=$row->getQuantiteP()*$row1->getPrix();
                    array_push($pm,$pm1);
                }
            }
        }
        return $this->render('panierencours/index.html.twig',
           ['pm'=>$pm , 'somme' =>$somme]
        );
    }

    /**
     * @Route("/DeleteFromPanier/{id}",name="deletefrontpanier")
     */
    public function DeleteFromPanierEnCours(PanierencoursRepository $repository , $id){
        $Panierencours=$repository->find(array ('idPanier' => 1, 'idMateriel' => $id));
        $em=$this->getDoctrine()->getManager();
        $em->remove($Panierencours);
        $em->flush();
        return $this->redirectToRoute('ReadPEC');
    }

    /**
     * @return Response
     * @Route("/Set/{idmateriel}/{quantitemat}", name="setidquantity")
     */
    public function SetIDandQuantite(PanierencoursRepository $repository , MaterielRepository $rep ,$idmateriel , $quantitemat ){
        $Panierencours=new Panierencours();
        $Search = new Search();
        $form1=$this->createForm(SearchType::class,$Search);
        $form1->add('Search',SubmitType::class);
        $form=$this->createForm(PanierEnCoursType::class,$Panierencours);
        $form->add('Confirm',SubmitType::class);
        $Materiel=$rep->findAll();
        $Panierencours1=$repository->find(array ('idPanier' => 1, 'idMateriel' => $idmateriel));
        if ($Panierencours1== null ) {
            return $this->render('materiel/quantity.html.twig',[
                'idmateriel'=>$idmateriel , 'quantitemat' =>$quantitemat , 'f'=>$form->createView() , 'error'=>false
            ]);
        }
        else {
            $alert=true;
            echo "<script>alert(\"Vous avez déjà choisi ce matériel..\")</script>" ;
            return $this->render('materiel/readfront.html.twig',[
                'form'=>$form1->createView() , 'f'=>$form->createView() , 'materiel'=>$Materiel
            ]);
        }
    }


    /**
     * @param Request $request
     * @param $idmateriel
     * @param $quantitemat
     * @return Response
     * @Route("/AddPanierEnCours/{idmateriel}/{quantitemat}",name="AddPEC")
     */
    public function AddPanierEnCours(Request $request , $idmateriel , $quantitemat){
        $Panierencours=new Panierencours();
        $form=$this->createForm(PanierEnCoursType::class,$Panierencours);
        $form->add('Confirm',SubmitType::class);
      //  $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));
            if ($form->isSubmitted() && $form->isValid()) {
                $qtp =$Panierencours->getQuantiteP();
                if (intval($qtp) <= intval($quantitemat)) {
                    $Panierencours->setQuantiteP($qtp);
                    $Panierencours->setIdMateriel($idmateriel);
                    $Panierencours->setIdPanier(1);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($Panierencours);
                    $em->flush();
                    return $this->redirectToRoute('ReadPEC');
                }
                else{
                    return $this->render('materiel/quantity.html.twig',[
                        'idmateriel'=>$idmateriel , 'quantitemat' =>$quantitemat , 'f'=>$form->createView() , 'error'=>true
                    ]);
                }

            }
        }
        return $this->redirectToRoute('ReadF');
    }

    /**
     * @param PanierencoursRepository $rep
     * @param PanierRepository $repository
     * @param HistoriqueRepository $repo
     * @return Response
     * @Route("/ConfirmBuy" , name="confirmation")
     */
    public function ConfirmBuy(PanierencoursRepository $rep , PanierRepository $repository , HistoriqueRepository $repo){
        $Panier=$repository->findBy(array('idPanier' => 1));
        $Panierencours=$rep->findBy(array('idPanier' => 1));
        foreach ($Panier as $row) {
            $Materiel = $row->getIdMateriel();
        }
            foreach ($Panierencours as $row)
            {
                foreach ($Materiel as $row1)
                {
                    if ($row->getIdMateriel()==$row1->getIdMateriel()){
                        $Historique=new Historique();
                        $Historique->setIdpanier(1);
                        $Historique->setNomMateriel($row1->getNom());
                        $Historique->setQuantite($row->getQuantiteP());
                        $Historique->setPrixu($row1->getPrix());
                        $Historique->setDate(date('d/m/Y'));
                        $row1->setQuantite($row1->getQuantite()-$row->getQuantiteP());
                        $em=$this->getDoctrine()->getManager();
                        $Panierencours1=$rep->find(array ('idPanier' => 1, 'idMateriel' => $row->getIdMateriel()));
                        $em->persist($Historique);
                        $em->remove($Panierencours1);
                        $em->flush();
                    }
                }
            }
        return $this->redirectToRoute('ReadF');
    }

    /**
     * @param HistoriqueRepository $repository
     * @return Response
     * @Route("/Recu" , name="Recu")
     */
    public function Recu(HistoriqueRepository $repository){
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $historique=$repository->findBy(array('idpanier' => 1));
        $var = count($historique);
        $var = floor(count($historique)/2)+1;
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('panierencours/pdfrecu.html.twig', [
            'listh' => $historique , 'length' => $var
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }

   /* /**
     * @param TexterInterface $texter
     * @return void
     * @Route("/BuySuccess" , name="buysuccess")
     */
  /*  public function Sendsms(TexterInterface $texter){
        $sms = new SmsMessage(
        // the phone number to send the SMS message to
            '+21628681688',
            // the message
            'A new login was detected!'
        );
        $sentMessage = $texter->send($sms);
    }*/
  }
