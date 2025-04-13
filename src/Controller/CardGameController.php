<?php

namespace App\Controller;

// use App\Dice\Card;
// use App\Dice\CardHand;
// use App\Dice\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardGameController extends AbstractController
{
    #[Route("/session", name: "session")]
    public function session(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $session->set("card", 0);
        $session->set("card_hand", 0);
        $session->set("deck_of_cards", 0);

        $data = [
            "card" => $session->get("card"),
            "cardHand" => $session->get("card_hand"),
            "deckOfCards" => $session->get("deck_of_cards"),
        ];

        return $this->render('session.html.twig', $data);
    }

    #[Route("/session/delete", name: "sessionDelete")]
    public function sessionDelete(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $session->set("card", null);
        $session->set("card_hand", null);
        $session->set("deck_of_cards", null);

        $data = [
            "card" => $session->get("card"),
            "cardHand" => $session->get("card_hand"),
            "deckOfCards" => $session->get("deck_of_cards"),
        ];

        return $this->render('session_delete.html.twig', $data);
    }

    #[Route("/card", name: "card")]
    public function card(): Response
    {
        return $this->render('card/card.html.twig');
    }

    #[Route("/card/deck", name: "deck")]
    public function deck(): Response
    {
        return $this->render('card/deck.html.twig');
    }

    #[Route("/card/deck/shuffle", name: "shuffle")]
    public function shuffle(): Response
    {
        return $this->render('card/shuffle.html.twig');
    }

    #[Route("/card/deck/draw", name: "draw")]
    public function draw(): Response
    {
        return $this->render('card/draw.html.twig');
    }
}