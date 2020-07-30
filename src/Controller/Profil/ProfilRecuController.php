<?php

namespace App\Controller\Profil;

use App\Entity\CommandePredefine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 *  @Route("/profile", name="profile_")
 */

class ProfilRecuController extends AbstractController
{
    /**
     * @Route("/logo/{id}/Reçu", name="recu_logo")
     */
    public function logo(CommandePredefine $commandePredifine)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('profil/recu/logo.html.twig', [
            'title' => "Reçu Affoubenou",
            'commandePredifine'=>$commandePredifine,
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Facture_Affoubenou.pdf", [
            "Attachment" => false
        ]); 
    }
}
