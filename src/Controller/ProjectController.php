<?php

namespace App\Controller;

use App\Project\Table;
use App\Card\DeckOfCards;
use App\Card\CardGraphic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProjectController extends AbstractController
{
    #[Route("/proj/about", name: "proj_about")]
    public function projAbout(
    ): Response {
        return $this->render('project/proj_about.html.twig');
    }

    #[Route("/proj", name: "proj_init")]
    public function init(
        SessionInterface $session
    ): Response {
        $table = new Table();
        $deck = new DeckOfCards();

        $session->set("table", $table);
        $session->set("deck_of_cards", $deck);

        return $this->render('project/square_init.html.twig');
    }

    #[Route("/proj/square_board", name: "square_board")]
    public function squareBoard(
        SessionInterface $session
    ): Response {
        $table = $session->get("table");
        $deck = $session->get("deck_of_cards");

        $randomCard = $deck->drawRandomCardCard();
        $randomCardArr = $randomCard->getCard();

        $color = "black";
        if ($randomCardArr[2] == "heart" || $randomCardArr[2] == "diamond") {
            $color = "red";
        }

        $data = [
            "randomCard" => $randomCard,
            "randomCardArr" => $randomCardArr,
            "randomColor" => $color,
            "table" => $table->getTableAsString()
        ];

        return $this->render('project/square_board.html.twig', $data);
    }

    #[Route("/proj/square_board_post", name: "square_board_post", methods: ['POST'])]
    public function squareBoardPost(
        SessionInterface $session,
        Request $request
    ): Response {
        $row = $request->request->get('row');
        $col = $request->request->get('col');
        $value = $request->request->get('value');
        $color = $request->request->get('color');

        $table = $session->get("table");

        if ($request->request->get('test')) {
            $table = new Table();
            $testing = $request->request->get('test');

            if ($testing == 'full deck') {
                $card00 = new CardGraphic(12, "heart");
                $card01 = new CardGraphic(13, "heart");
                $card02 = new CardGraphic(1, "heart");
                $card03 = new CardGraphic(11, "heart");
                $card04 = new CardGraphic(10, "heart");

                $card10 = new CardGraphic(11, "spade");
                $card11 = new CardGraphic(9, "spade");
                $card13 = new CardGraphic(8, "spade");
                $card14 = new CardGraphic(7, "spade");

                $card20 = new CardGraphic(9, "diamond");
                $card21 = new CardGraphic(11, "diamond");
                $card22 = new CardGraphic(11, "diamond");
                $card23 = new CardGraphic(10, "diamond");
                $card24 = new CardGraphic(7, "diamond");

                $card30 = new CardGraphic(9, "spade");
                $card31 = new CardGraphic(9, "diamond");
                $card32 = new CardGraphic(13, "heart");
                $card33 = new CardGraphic(9, "spade");
                $card34 = new CardGraphic(9, "club");

                $card40 = new CardGraphic(9, "club");
                $card41 = new CardGraphic(12, "diamond");
                $card42 = new CardGraphic(12, "spade");
                $card43 = new CardGraphic(12, "club");
                $card44 = new CardGraphic(9, "heart");


                $table = new Table();


                $table->insertCard(0, 0, $card00);
                $table->insertCard(0, 1, $card01);
                $table->insertCard(0, 2, $card02);
                $table->insertCard(0, 3, $card03);
                $table->insertCard(0, 4, $card04);

                $table->insertCard(1, 0, $card10);
                $table->insertCard(1, 1, $card11);
                $table->insertCard(1, 3, $card13);
                $table->insertCard(1, 4, $card14);

                $table->insertCard(2, 0, $card20);
                $table->insertCard(2, 1, $card21);
                $table->insertCard(2, 2, $card22);
                $table->insertCard(2, 3, $card23);
                $table->insertCard(2, 4, $card24);

                $table->insertCard(3, 0, $card30);
                $table->insertCard(3, 1, $card31);
                $table->insertCard(3, 2, $card32);
                $table->insertCard(3, 3, $card33);
                $table->insertCard(3, 4, $card34);

                $table->insertCard(4, 0, $card40);
                $table->insertCard(4, 1, $card41);
                $table->insertCard(4, 2, $card42);
                $table->insertCard(4, 3, $card43);
                $table->insertCard(4, 4, $card44);
            }
        }

        $tempCard = new CardGraphic((int)$value, (string)$color);

        $table->insertCard((int)$row, (int)$col, $tempCard);
        $session->set("table", $table);

        if ($table->checkIfFull()) {
            return $this->redirect('/proj/square_board_finished');
        }
        return $this->redirect('/proj/square_board');
    }

    #[Route("/proj/square_board_finished", name: "square_board_finished")]
    public function squareBoardFinished(
        SessionInterface $session,
        Request $request
    ): Response {
        $testing = $request->query->get('testing');

        $table = $session->get("table");
        if ($testing == 'true') {

            $card00 = new CardGraphic(12, "heart");
            $card01 = new CardGraphic(13, "heart");
            $card02 = new CardGraphic(1, "heart");
            $card03 = new CardGraphic(11, "heart");
            $card04 = new CardGraphic(10, "heart");

            $card10 = new CardGraphic(11, "spade");
            $card11 = new CardGraphic(9, "spade");
            $card12 = new CardGraphic(10, "spade");
            $card13 = new CardGraphic(8, "spade");
            $card14 = new CardGraphic(7, "spade");

            $card20 = new CardGraphic(9, "diamond");
            $card21 = new CardGraphic(11, "diamond");
            $card22 = new CardGraphic(11, "diamond");
            $card23 = new CardGraphic(10, "diamond");
            $card24 = new CardGraphic(7, "diamond");

            $card30 = new CardGraphic(9, "spade");
            $card31 = new CardGraphic(9, "diamond");
            $card32 = new CardGraphic(13, "heart");
            $card33 = new CardGraphic(9, "spade");
            $card34 = new CardGraphic(9, "club");

            $card40 = new CardGraphic(9, "club");
            $card41 = new CardGraphic(12, "diamond");
            $card42 = new CardGraphic(12, "spade");
            $card43 = new CardGraphic(12, "club");
            $card44 = new CardGraphic(9, "heart");

            $table = new Table();


            $table->insertCard(0, 0, $card00);
            $table->insertCard(0, 1, $card01);
            $table->insertCard(0, 2, $card02);
            $table->insertCard(0, 3, $card03);
            $table->insertCard(0, 4, $card04);

            $table->insertCard(1, 0, $card10);
            $table->insertCard(1, 1, $card11);
            $table->insertCard(1, 2, $card12);
            $table->insertCard(1, 3, $card13);
            $table->insertCard(1, 4, $card14);

            $table->insertCard(2, 0, $card20);
            $table->insertCard(2, 1, $card21);
            $table->insertCard(2, 2, $card22);
            $table->insertCard(2, 3, $card23);
            $table->insertCard(2, 4, $card24);

            $table->insertCard(3, 0, $card30);
            $table->insertCard(3, 1, $card31);
            $table->insertCard(3, 2, $card32);
            $table->insertCard(3, 3, $card33);
            $table->insertCard(3, 4, $card34);

            $table->insertCard(4, 0, $card40);
            $table->insertCard(4, 1, $card41);
            $table->insertCard(4, 2, $card42);
            $table->insertCard(4, 3, $card43);
            $table->insertCard(4, 4, $card44);
        }

        $points = $table->calculateScore();

        if ($points[0] == "Not all cards is in table!") {
            $data = [
                "amePoints" => "0",
                "engPoints" => "0",
                "ameWin" => "Not all cards is done, finish game!",
                "engWin" => "Not all cards is done, finish game!",
                "table" => $table->getTableAsString()
            ];

            return $this->render('project/square_board_finished.html.twig', $data);
        }

        $data = [
            "amePoints" => $points[0],
            "engPoints" => $points[1],
            "ameWin" => $points[2],
            "engWin" => $points[3],
            "table" => $table->getTableAsString()
        ];

        return $this->render('project/square_board_finished.html.twig', $data);
    }

    #[Route("/proj/api", name: "proj_api")]
    public function api(): Response
    {
        $routes = [
            'DeckOfCards' => 'proj_api_deck',
            'Table array' => 'proj_api_table',
            'Table array as string' => 'proj_api_table_string',
            'Check if table array is full' => 'proj_api_table_is_full',
            'Score' => 'proj_api_score',
            'Delete session' => 'proj_delete',
        ];

        $data = [
            'routes' => $routes,
        ];

        return $this->render('project/proj_api.html.twig', $data);
    }
}
