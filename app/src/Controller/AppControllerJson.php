<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppControllerJson
{
    #[Route("/api/quote", name: "quote")]
    public function jsonQuote(): Response
    {
        $quote = [
            0 => '“Two things are infinite: the universe and human stupidity; and I\'m not sure about the universe.” ― Albert Einstein',
            1 => '“Be yourself; everyone else is already taken.” ― Oscar Wilde',
            2 => '“You\'ve gotta dance like there\'s nobody watching, Love like you\'ll never be hurt, Sing like there\'s nobody listening, And live like it\'s heaven on earth.” ― William W. Purkey',
            3 => '“If you tell the truth, you don\'t have to remember anything.” ― Mark Twain',
        ];

        $number = random_int(0, 3);

        date_default_timezone_set("Europe/Stockholm");
        $data = [
            "quote" => $quote[$number],
            "date" => date("Y-m-d"),
            "timestamp" => date("h:i:sa"),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}