<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppControllerTwig extends AbstractController
{
    #[Route("/", name: "home")]
    public function home(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'number' => $number
        ];

        return $this->render('home.html.twig', $data);
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'number' => $number
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/api", name: "api")]
    public function api(): Response
    {
        $routes = [
            'Quotes' => 'quote',
            'Deck' => 'api_deck',
            'Shuffle' => 'api_shuffle',
            'Draw' => 'api_draw',
            'Game' => 'api_game',
            'Library' => 'library_show_all_api',
        ];

        $data = [
            'routes' => $routes,
        ];

        return $this->render('api.html.twig', $data);
    }

    #[Route("/metrics", name: "metrics")]
    public function Metrics(): Response
    {
        return $this->render('metrics.html.twig');
    }
}
