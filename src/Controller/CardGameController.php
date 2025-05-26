<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardGameController extends AbstractController
{
    #[Route("/session", name: "session")]
    public function session(
        SessionInterface $session
    ): Response {
        if (!$session->get("card_hand")) {
            $deck = new DeckOfCards();
            $hand = new CardHand($deck);

            $session->set("card_hand", $hand);
        }
        $data = [
            "cardHand" => $session->get("card_hand"),
        ];

        return $this->render('session.html.twig', $data);
    }

    #[Route("/session/delete", name: "sessionDelete")]
    public function sessionDelete(
        SessionInterface $session
    ): Response {
        $session->set("card_hand", null);

        $this->addFlash(
            'notice',
            'Nu är sessionen raderad'
        );

        $data = [
            "cardHand" => $session->get("card_hand"),
        ];

        return $this->render('session_delete.html.twig', $data);
    }

    #[Route("/card", name: "card")]
    public function card(
        SessionInterface $session
    ): Response {
        if (!$session->get("card_hand")) {
            $deck = new DeckOfCards();
            $hand = new CardHand($deck);

            $session->set("card_hand", $hand);
        }

        return $this->render('card/card.html.twig');
    }

    #[Route("/card/deck", name: "deck")]
    public function deck(
        SessionInterface $session
    ): Response {
        if (!$session->get("card_hand")) {
            $deck = new DeckOfCards();
            $hand = new CardHand($deck);

            $session->set("card_hand", $hand);
        }

        $hand = $session->get("card_hand");
        $deck = $hand->getDeck();
        $data = [
            "deck" => $deck->getDeckInOrder()
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffle", name: "shuffle")]
    public function shuffle(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        $hand = new CardHand($deck);

        $session->set("card_hand", $hand);

        $hand = $session->get("card_hand");
        $deck = $hand->getDeck();
        $data = [
            "deck" => $deck->getDeckInRandom(),
            "numOfCards" => $hand->getDecksNumOfCards()
        ];
        return $this->render('card/shuffle.html.twig', $data);
    }

    #[Route("/card/deck/draw", name: "draw")]
    public function draw(
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards")) {
            $deck = new DeckOfCards();
            $hand = new CardHand($deck);

            $session->set("card_hand", $hand);
        }

        $hand = $session->get("card_hand");

        $drawCardOk = $hand->drawCard();

        if ($drawCardOk[0] !== "ok") {
            $this->addFlash(
                $drawCardOk[0],
                $drawCardOk[1]
            );
        }

        $data = [
            "hand" => $hand->showHand(),
            "numOfCards" => $hand->getDecksNumOfCards()
        ];

        return $this->render('card/draw.html.twig', $data);
    }

    #[Route("/card/deck/draw/{num<\d+>}", name: "draw_more")]
    public function drawMore(
        int $num,
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards")) {
            $deck = new DeckOfCards();
            $hand = new CardHand($deck);

            $session->set("deck_of_cards", $deck);
            $session->set("card_hand", $hand);
        }

        $hand = $session->get("card_hand");

        $drawCardOk = $hand->drawCard($num);

        if ($drawCardOk[0] !== "ok") {
            $this->addFlash(
                $drawCardOk[0],
                $drawCardOk[1]
            );
        }


        $data = [
            "hand" => $hand->showHand(),
            "numOfCards" => $hand->getDecksNumOfCards()
        ];

        return $this->render('card/draw.html.twig', $data);
    }
}
