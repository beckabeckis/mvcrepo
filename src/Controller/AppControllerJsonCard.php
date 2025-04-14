<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AppControllerJsonCard
{
    #[Route("/api/deck", name: "api_deck")]
    public function jsonDeck(
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards")) {
            $deckofCards = new DeckOfCards();
            $cardHand = new CardHand($deckofCards);

            $session->set("deck_of_cards", $deckofCards);
            $session->set("card_hand", $cardHand);
        }

        $deck = $session->get("deck_of_cards");
        $data = [
            "deck" => $deck->getDeckInOrder()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_shuffle")]
    public function jsonShuffle(
        SessionInterface $session
    ): Response {
        $deckofCards = new DeckOfCards();
        $cardHand = new CardHand($deckofCards);

        $session->set("deck_of_cards", $deckofCards);
        $session->set("card_hand", $cardHand);

        $deck = $session->get("deck_of_cards");
        $data = [
            "deck" => $deck->getDeckInRandom()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw", name: "api_draw")]
    public function jsonDraw(
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards")) {
            $deckofCards = new DeckOfCards();
            $cardHand = new CardHand($deckofCards);

            $session->set("deck_of_cards", $deckofCards);
            $session->set("card_hand", $cardHand);
        }

        $hand = $session->get("card_hand");
        $deck = $session->get("deck_of_cards");

        $numOfCards = $deck->getNumOfCards();

        if ($numOfCards != 0) {
            $hand->drawCard();
        }

        $data = [
            "hand" => $hand->showCards(),
            "numOfCards" => $deck->getNumOfCards()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw/{num<\d+>}", name: "api_draw_more")]
    public function jsonDraw_more(
        int $num,
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards")) {
            $deckofCards = new DeckOfCards();
            $cardHand = new CardHand($deckofCards);

            $session->set("deck_of_cards", $deckofCards);
            $session->set("card_hand", $cardHand);
        }

        $hand = $session->get("card_hand");
        $deck = $session->get("deck_of_cards");

        $numOfCards = $deck->getNumOfCards();

        if ($numOfCards == 0 || $numOfCards < $num) {
            $hand->drawCard($numOfCards);
        } else {
            $hand->drawCard($num);
        }

        $data = [
            "hand" => $hand->showCards(),
            "numOfCards" => $deck->getNumOfCards()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
