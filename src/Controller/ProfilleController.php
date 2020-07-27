<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ProfilleController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER") 
     * @Route("/user", name="app_profil_user")
     */
    public function profil()
    {
        return $this->redirectToRoute('profile_index');
    }
}
