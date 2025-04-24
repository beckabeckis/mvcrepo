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
        // Request $request,
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards")) {
            $deck = new DeckOfCards();
            $hand = new CardHand($deck);

            $session->set("deck_of_cards", $deck);
            $session->set("card_hand", $hand);
        }
        $data = [
            "deckOfCards" => $session->get("deck_of_cards"),
            "cardHand" => $session->get("card_hand"),
        ];

        return $this->render('session.html.twig', $data);
    }

    #[Route("/session/delete", name: "sessionDelete")]
    public function sessionDelete(
        // Request $request,
        SessionInterface $session
    ): Response {
        $session->set("card_hand", null);
        $session->set("deck_of_cards", null);

        $this->addFlash(
            'notice',
            'Nu är sessionen raderad'
        );

        $data = [
            "cardHand" => $session->get("card_hand"),
            "deckOfCards" => $session->get("deck_of_cards"),
        ];

        return $this->render('session_delete.html.twig', $data);
    }

    #[Route("/card", name: "card")]
    public function card(
        // Request $request,
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards")) {
            $deck = new DeckOfCards();
            $hand = new CardHand($deck);

            $session->set("deck_of_cards", $deck);
            $session->set("card_hand", $hand);
        }

        return $this->render('card/card.html.twig');
    }

    #[Route("/card/deck", name: "deck")]
    public function deck(
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards")) {
            $deck = new DeckOfCards();
            $hand = new CardHand($deck);

            $session->set("deck_of_cards", $deck);
            $session->set("card_hand", $hand);
        }

        $deck = $session->get("deck_of_cards");
        $data = [
            "deck" => $deck->getDeckInOrder()
        ];

        // var_dump($data["deck"]);

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffle", name: "shuffle")]
    public function shuffle(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        $hand = new CardHand($deck);

        $session->set("deck_of_cards", $deck);
        $session->set("card_hand", $hand);

        $deck = $session->get("deck_of_cards");
        $data = [
            "deck" => $deck->getDeckInRandom(),
            "numOfCards" => $deck->getNumOfCards()
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

            $session->set("deck_of_cards", $deck);
            $session->set("card_hand", $hand);
        }

        $hand = $session->get("card_hand");
        $deck = $session->get("deck_of_cards");

        $numOfCards = $deck->getNumOfCards();


        if ($numOfCards == 0) {
            $this->addFlash(
                'warning',
                'No more cards!'
            );
        } elseif (!$numOfCards == 0) {
            $hand->drawCard();
        }

        $data = [
            "hand" => $hand->showCards(),
            "numOfCards" => $deck->getNumOfCards()
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
        $deck = $session->get("deck_of_cards");

        $numOfCards = $deck->getNumOfCards();

        if ($numOfCards == 0) {
            $this->addFlash(
                'warning',
                'No more cards!'
            );
        } elseif ($numOfCards <= $num) {
            $hand->drawCard($numOfCards);
            $this->addFlash(
                'notice',
                'You took the last off the cards!'
            );
        } elseif ($numOfCards > $num) {
            $hand->drawCard($num);
        }

        $data = [
            "hand" => $hand->showCards(),
            "numOfCards" => $deck->getNumOfCards()
        ];

        return $this->render('card/draw.html.twig', $data);
    }
}
