<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SportsBettingController extends AbstractController
{
    /**
     * @Route("/sports/betting", name="sports_betting")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SportsBettingController.php',
        ]);
    }
}
