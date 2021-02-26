<?php

namespace TennisGame;

use phpDocumentor\Reflection\Types\Boolean;

class TennisGame1 implements TennisGame {

    private $m_score1 = 0;

    private $m_score2 = 0;

    private $player1Name = '';

    private $player2Name = '';

    public function __construct($player1Name, $player2Name) {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint($playerName) {
        if ('player1' == $playerName) {
            $this->m_score1++;
        }
        else {
            $this->m_score2++;
        }
    }

    public function getScore() {
        if ($this->isEquales()) {
            return $this->getEqualesScore();
        }
        $score = $this->getGameScore($this->m_score1, $this->m_score2);

        return $score;
    }

    private function isEquales() {
        if ($this->m_score1 == $this->m_score2) {
            return TRUE;
        }
        return FALSE;
    }

    private function getEqualesScore() {
        $posiblesScores = [
            0 => 'Love-All',
            1 => 'Fifteen-All',
            2 => 'Thirty-All',
        ];
        return array_key_exists($this->m_score2, $posiblesScores) ? $posiblesScores[$this->m_score2] : 'Deuce';
    }


    private function getGameScore($m_score1, $m_score2) {
        if ($this->m_score1 >= 4 && $this->m_score2 >= 4) {
            $minusResult = $this->m_score1 - $this->m_score2;
            return $this->getAdventageScore($minusResult);
        }
        $posiblesScores = [
            0 => 'Love',
            1 => 'Fifteen',
            2 => 'Thirty',
            3 => 'Forty',
        ];
        if ($m_score1 == 4) {
            if ($m_score2 == 3) {
                return 'Advantage player1';
            }
            return 'Win for player1';
        }
        if ($m_score2 == 4) {
            if ($m_score1 == 3) {
                return 'Advantage player2';
            }
            return 'Win for player2';
        }
        return $posiblesScores[$m_score1] . "-" . $posiblesScores[$m_score2];
    }

    private function getAdventageScore($minusResult) {
        $posiblesScores = [
            -1 => 'Advantage player2',
            1 => 'Advantage player1',
            2 => 'Win for player1',
            -2 => 'Win for player2',
        ];
        return $posiblesScores[$minusResult];

    }
}
