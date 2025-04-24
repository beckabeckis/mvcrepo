<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use App\Card\PlayerCardHand;
use App\Card\BankCardHand;
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
    public function jsonDrawMore(
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

        $drawCards = $num;
        if ($numOfCards == 0 || $numOfCards < $num) {
            $drawCards = $numOfCards;
        }

        $hand->drawCard($drawCards);

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

    #[Route("/api/game", name: "api_game")]
    public function jsonGame(
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards_game")) {
            $deck = new DeckOfCards();
            $playerHand = new PlayerCardHand($deck);
            $bankHand = new BankCardHand($deck);

            $session->set("deck_of_cards_game", $deck);
            $session->set("player_card_hand", $playerHand);
            $session->set("bank_card_hand", $bankHand);
        }

        $playerHand = $session->get("player_card_hand");
        $bankHand = $session->get("bank_card_hand");
        $data = [
            'player_points' => $playerHand->getTotalPoints(),
            'bank_points' => $bankHand->getTotalPoints()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

}
