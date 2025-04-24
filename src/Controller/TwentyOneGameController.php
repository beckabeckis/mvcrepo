<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use App\Card\PlayerCardHand;
use App\Card\BankCardHand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TwentyOneGameController extends AbstractController
{
    #[Route("/game", name: "game")]
    public function card(): Response
    {
        return $this->render('game/game.html.twig');
    }

    #[Route("/game/doc", name: "doc")]
    public function doc(): Response
    {
        return $this->render('game/doc.html.twig');
    }

    #[Route("/game/board", name: "board")]
    public function board(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        $playerHand = new PlayerCardHand($deck);
        $bankHand = new BankCardHand($deck);

        $session->set("deck_of_cards_game", $deck);
        $session->set("player_card_hand", $playerHand);
        $session->set("bank_card_hand", $bankHand);

        $data = [
            'essHidden' => "hidden",
            'drawHidden' => "shown",
            'stopHidden' => "hidden",
            'agianHidden' => "hidden"
        ];

        return $this->render('game/board.html.twig', $data);
    }

    #[Route("/game/board_drawn", name: "board_drawn")]
    public function boardDrawn(
        SessionInterface $session
    ): Response {
        $playerHand = $session->get("player_card_hand");
        $bankHand = $session->get("bank_card_hand");
        $isEss = $playerHand->drawPlayerCard();
        $data = [
                'player_hand' => $playerHand->showCards(),
                'player_points' => $playerHand->getTotalPoints(),
                'bank_hand' => $bankHand->showCards(),
                'bank_points' => $bankHand->getTotalPoints(),
                'essHidden' => "shown",
                'drawHidden' => "hidden",
                'stopHidden' => "hidden",
                'agianHidden' => "hidden"
            ];

        if ($isEss !== -1) {
            if ($playerHand->getTotalPoints() == 21) {
                $this->addFlash(
                    'notice',
                    'Du Vann!'
                );
                return $this->redirect('board_lost');
            } elseif ($playerHand->getTotalPoints() > 21) {
                $this->addFlash(
                    'warning',
                    'Du förlorade!'
                );
                return $this->redirect('board_lost');
            }

            $data = [
                'player_hand' => $playerHand->showCards(),
                'player_points' => $playerHand->getTotalPoints(),
                'bank_hand' => $bankHand->showCards(),
                'bank_points' => $bankHand->getTotalPoints(),
                'essHidden' => "hidden",
                'drawHidden' => "shown",
                'stopHidden' => "shown",
                'agianHidden' => "hidden"
            ];
        }

        return $this->render('game/board_drawn.html.twig', $data);
    }

    #[Route("/game/board_one", name: "board_one", methods: ['POST'])]
    public function boardOne(
        SessionInterface $session
    ): Response {
        $playerHand = $session->get("player_card_hand");
        $playerHand->addPoints(1);

        return $this->redirect('board_ess');
    }

    #[Route("/game/board_thirteen", name: "board_thirteen", methods: ['POST'])]
    public function boardThirteen(
        SessionInterface $session
    ): Response {
        $playerHand = $session->get("player_card_hand");
        $playerHand->addPoints(13);

        return $this->redirect('board_ess');
    }

    #[Route("/game/board_ess", name: "board_ess")]
    public function boardEss(
        SessionInterface $session
    ): Response {
        $playerHand = $session->get("player_card_hand");
        $bankHand = $session->get("bank_card_hand");
        $data = [
            'player_hand' => $playerHand->showCards(),
            'player_points' => $playerHand->getTotalPoints(),
            'bank_hand' => $bankHand->showCards(),
            'bank_points' => $bankHand->getTotalPoints(),
            'essHidden' => "hidden",
            'drawHidden' => "shown",
            'stopHidden' => "shown",
            'agianHidden' => "hidden"
        ];

        return $this->render('game/board_drawn.html.twig', $data);
    }

    #[Route("/game/board_lost", name: "board_lost")]
    public function boardLost(
        SessionInterface $session
    ): Response {
        $playerHand = $session->get("player_card_hand");
        $bankHand = $session->get("bank_card_hand");
        $data = [
            'player_hand' => $playerHand->showCards(),
            'player_points' => $playerHand->getTotalPoints(),
            'bank_hand' => $bankHand->showCards(),
            'bank_points' => $bankHand->getTotalPoints(),
            'essHidden' => "hidden",
            'drawHidden' => "hidden",
            'stopHidden' => "hidden",
            'agianHidden' => "shown"
        ];

        return $this->render('game/board_drawn.html.twig', $data);
    }

    #[Route("/game/board_end", name: "board_end")]
    public function boardEnd(
        SessionInterface $session
    ): Response {
        $playerHand = $session->get("player_card_hand");
        $bankHand = $session->get("bank_card_hand");

        $bankHand->playGame();

        if ($bankHand->getTotalPoints() > 21 || $bankHand->getTotalPoints() < $playerHand->getTotalPoints()) {
            $this->addFlash(
                'notice',
                'Du Vann!'
            );
        } elseif ($bankHand->getTotalPoints() > $playerHand->getTotalPoints()) {
            $this->addFlash(
                'warning',
                'Du förlorade!'
            );
        } elseif ($bankHand->getTotalPoints() == $playerHand->getTotalPoints()) {
            $this->addFlash(
                'notice',
                'Det vart lika!'
            );
        }

        $data = [
            'player_hand' => $playerHand->showCards(),
            'player_points' => $playerHand->getTotalPoints(),
            'bank_hand' => $bankHand->showCards(),
            'bank_points' => $bankHand->getTotalPoints(),
            'essHidden' => "hidden",
            'drawHidden' => "hidden",
            'stopHidden' => "hidden",
            'agianHidden' => "shown"
        ];

        return $this->render('game/board_drawn.html.twig', $data);
    }
}
