<?php

namespace App\Controller;

use App\Project\Table;
use App\Card\DeckOfCards;
use App\Card\CardGraphic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProjectControllerJson extends AbstractController
{
    #[Route("/proj/api/deck", name: "proj_api_deck")]
    public function jsonDeck(
        SessionInterface $session
    ): Response {
        if (!$session->get("deck_of_cards")) {
            $deck = new DeckOfCards();
            $session->set("deck_of_cards", $deck);
        };

        $deck = $session->get("deck_of_cards");
        $deckCards = $deck->getDeckInOrder();
        $data = [
            "deck_of_cards" => $deckCards
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/proj/api/table", name: "proj_api_table")]
    public function jsonTable(
        SessionInterface $session
    ): Response {
        if (!$session->get("table")) {
            $table = new Table();

            $session->set("table", $table);
        };

        $table = $session->get("table");
        $tableArr = $table->getTable();

        $data = [
            "table" => $tableArr
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/proj/api/table_string", name: "proj_api_table_string")]
    public function jsonTableAsString(
        SessionInterface $session
    ): Response {
        if (!$session->get("table")) {
            $table = new Table();

            $session->set("table", $table);
        };

        $table = $session->get("table");
        $tableAsString = $table->getTableAsString();
        $data = [
            "table_as_string" => $tableAsString
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/proj/api/table_is_full", name: "proj_api_table_is_full")]
    public function jsonTableIsFull(
        SessionInterface $session
    ): Response {
        if (!$session->get("table")) {
            $table = new Table();

            $session->set("table", $table);
        };

        $table = $session->get("table");
        $isFull = $table->checkIfFull();
        $data = [
            "table_is_full" => $isFull
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/proj/api/score", name: "proj_api_score")]
    public function jsonScore(
        SessionInterface $session
    ): Response {
        if (!$session->get("table")) {
            $table = new Table();

            $session->set("table", $table);
        };

        $table = $session->get("table");
        $score = $table->calculateScore();
        $data = [
            "score" => $score
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/proj/api/delete", name: "proj_delete")]
    public function jsonDelete(
        SessionInterface $session
    ): Response {
        $session->set("table", null);
        $session->set("deck_of_cards", null);

        $data = [
            "deck_of_cards" => $session->get("deck_of_cards"),
            "table" => $session->get("table")
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
