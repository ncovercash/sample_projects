<?php

class Card {
	public const suitEnum = Array(
		0 => "C", 
		1 => "D", 
		2 => "H",
		3 => "S" );
	public const flippedSuitEnum = Array(
		"C" => 0,
		"D" => 1,
		"H" => 2,
		"S" => 3 );

	public const valEnum = Array(
		0 => "2",
		1 => "3",
		2 => "4",
		3 => "5",
		4 => "6",
		5 => "7",
		6 => "8",
		7 => "9",
		8 => "T",
		9 => "J",
		10 => "Q",
		11 => "K",
		12 => "A" );
	public const flippedValEnum = Array(
		"2" => 0,
		"3" => 1,
		"4" => 2,
		"5" => 3,
		"6" => 4,
		"7" => 5,
		"8" => 6,
		"9" => 7,
		"T" => 8,
		"J" => 9,
		"Q" => 10,
		"K" => 11,
		"A" => 12 );

	private $suitVal;
	private $cardVal;
	
	public function __construct(string $val, string $suit) {
		$this->suitVal = self::flippedSuitEnum[$suit];
		$this->cardVal = self::flippedValEnum[$val];
	}

	public function __toString() : string {
		return self::valEnum[$this->cardVal].self::suitEnum[$this->suitVal];
	}

	public function compareTo(Card $b) : int {
		return self::compare($this, $b);
	}

	public static function compare(Card $a, Card $b) : int {
		return $a->cardVal - $b->cardVal;
	}

	public function getCardValue() : string {
		return self::valEnum[$this->cardVal];
	}

	public function getEnumeratedCardValue() : int {
		return $this->cardVal;
	}

	public function getCardSuit() : string {
		return self::suitEnum[$this->suitVal];
	}

	public function getEnumeratedCardSuit() : int {
		return $this->suitVal;
	}
}

class Factory {
	public static function createCardFromTuple(string $tuple) : Card {
		return new Card($tuple[0], $tuple[1]);
	}

	public static function createCardFromValues(string $val, string $suit) : Card {
		return new Card($suit, $val);
	}

	public static function createHandFromCards(Card ...$cards) : PokerHand {
		$hand = new PokerHand(...$cards);
		return $hand;
	}

	public static function createCardsFromCardString(string $cards) : array {
		$created = Array();
		$cards = explode(" ", $cards);
		foreach ($cards as $card) {
			$created[] = self::createCardFromTuple($card);
		}
		return $created;
	}

	public static function createHandFromCardString(string $cards) : PokerHand {
		$cardArray = self::createCardsFromCardString($cards);
		$hand = self::createHandFromCards(...$cardArray);
		return $hand;
	}

	public static function createHandsFromEulerString(string $string) : array {
		$player1 = substr($string, 0, 14);
		$player2 = substr($string, 15, 14);

		$hands = Array();
		$hands[] = self::createHandFromCardString($player1);
		$hands[] = self::createHandFromCardString($player2);

		return $hands;
	}

	public static function createNestedArraysFromEulerFile(string $fname) : array {
		$hands = Array();

		$lines = file($fname, FILE_SKIP_EMPTY_LINES+FILE_IGNORE_NEW_LINES);

		foreach ($lines as $line) {
			$hands[] = self::createHandsFromEulerString($line);
		}

		return $hands;
	}
}

class PokerHand {
	private $cards = Array();

	public function __construct(Card ...$cards) {
		$this->cards = $cards;
		usort($this->cards, "Card::compare");
	}

	public function __toString() : string {
		$returnStr = "";
		foreach ($this->cards as $card) {
			$returnStr .= $card->__toString();
			$returnStr .= " ";
		}
		return $returnStr;
	}

	public function addCard(Card $a) {
		$this->cards[] = $a;
	}

	public function getSets() : array {
		$numEachCard = Array();

		foreach ($this->cards as $card) {
			if (!isset($numEachCard[$card->getEnumeratedCardValue()])) {
				$numEachCard[$card->getEnumeratedCardValue()] = 0;
			}
			$numEachCard[$card->getEnumeratedCardValue()]++;
		}

		return $numEachCard;
	}

	public function getHighCard() : array {
		$highestEnumeratedValue = 0;
		$sets = $this->getSets();
		foreach ($sets as $key => $value) {
			if ($value == 1) {
				$highestEnumeratedValue = max($highestEnumeratedValue, $key);
			}
		}
		return Array(Array("0", $highestEnumeratedValue));
	}

	public function getPairs() : array {
		$returnArr = Array();
		$sets = $this->getSets();
		foreach ($sets as $key => $value) {
			if ($value == 2) {
				$returnArr[] = Array("1", $key);
			}
		}
		if (count($returnArr) >= 2) {
			$returnArr[] = Array("2", 0);
		}
		return $returnArr;
	}

	public function getTriplets() : array {
		$returnArr = Array();
		$sets = $this->getSets();
		foreach ($sets as $key => $value) {
			if ($value == 3) {
				$returnArr[] = Array("3", $key);
			}
		}
		return $returnArr;
	}

	public function getStraight() : array {
		$highestCard = $this->cards[count($this->cards)-1]->getEnumeratedCardValue();
		for ($i=0; $i < count($this->cards)-1; $i++) {
			if ($this->cards[$i]->getEnumeratedCardValue()+1 != $this->cards[$i+1]->getEnumeratedCardValue()) {
				return Array();
			}
		}
		return Array(Array("4", $highestCard));
	}

	public function getFlush() : array {
		$highestCard = $this->cards[count($this->cards)-1]->getEnumeratedCardValue();
		$suit = $this->cards[0]->getEnumeratedCardSuit();
		for ($i=1; $i < count($this->cards); $i++) {
			if ($this->cards[$i]->getEnumeratedCardSuit() != $suit) {
				return Array();
			}
		}
		return Array(Array("5", $highestCard));
	}

	public function getFullHouse() : array {
		$sets = $this->getSets();
		if (count($sets) != 2) {
			return Array();
		}
		$setOf3Num = 0;
		foreach ($sets as $cardnum => $num) {
			if ($num == 3) {
				$setOf3Num = $cardnum;
			}
			if ($num != 2 && $num != 3) {
				return Array(); // means we have a 4/1
			}
		}
		return Array(Array("6", $setOf3Num));
	}

	public function getFourOfAKind() : array {
		$returnArr = Array();
		$sets = $this->getSets();
		foreach ($sets as $key => $value) {
			if ($value == 4) {
				$returnArr[] = Array("7", $key);
			}
		}
		return $returnArr;
	}

	public function getStraightFlush() : array {
		if (count($this->getStraight()) == 1 && count($this->getFlush()) == 1) {
			return Array(Array("8", $this->getStraight()[0][1])); // get highest card from straight
		}
		return Array();
	}

	public function getRoyalFlush() : array {
		if (count($this->getStraight()) == 1 && count($this->getFlush()) == 1) {
			if ($this->cards[0]->getEnumeratedCardValue() == Card::flippedValEnum["T"]) {
				return Array(Array("9", 0)); // incomprable
			}
		}
		return Array();
	}

	public function getRanks() : array {
		$ranks = Array();
		// format of this array is as follows:
		//   value1 - priority rank, higher is better
		//   value2 - where applicable, the value to compare within the rank
		$ranks = array_merge($ranks, $this->getHighCard());
		$ranks = array_merge($ranks, $this->getPairs());
		$ranks = array_merge($ranks, $this->getTriplets());
		$ranks = array_merge($ranks, $this->getStraight());
		$ranks = array_merge($ranks, $this->getFlush());
		$ranks = array_merge($ranks, $this->getFullHouse());
		$ranks = array_merge($ranks, $this->getFourOfAKind());
		$ranks = array_merge($ranks, $this->getStraightFlush());
		$ranks = array_merge($ranks, $this->getRoyalFlush());

		return $ranks;
	}

	public function compareTo(PokerHand $b) : int {
		return self::compare($this, $b);
	}

	// returns -1 if hand 1 won, and 1 if hand 2 won
	// 0 if tie
	public static function compare(PokerHand $a, Pokerhand $b) : int {
		$aRanks = $a->getRanks();
		$bRanks = $b->getRanks();

		// check overall
		if ((int)$aRanks[count($aRanks)-1][0] > (int)$bRanks[count($bRanks)-1][0]) { // compare value1 priority rank
			return -1;
		} else if ((int)$aRanks[count($aRanks)-1][0] < (int)$bRanks[count($bRanks)-1][0]) {
			return 1;
		}
		
		if ($aRanks[count($aRanks)-1][1] > $bRanks[count($bRanks)-1][1]) { // compare value2 card rank
			return -1;
		} else if ($aRanks[count($aRanks)-1][1] > $bRanks[count($bRanks)-1][1]) {
			return 1;
		}

		$i = count($aRanks)-1;
		$j = count($bRanks)-1;

		while ($i >= 0 && $j >= 0) {
			if ((int)$aRanks[$i][0] == (int)$bRanks[$j][0]) {
				if ($aRanks[$i][1] != $bRanks[$j][1]) {
					if ($aRanks[$i][1] > $bRanks[$j][1]) {
						return -1;
					} else {
						return 1;
					}
				}
				$i--;
				$j--;
			} else {
				if ((int)$aRanks[$i][0] > (int)$bRanks[$j][0]) {
					return -1;
				} else {
					return 1;
				}
			}
		}
		if ($i < 0 && $j >= 0) {
			return 1; // then player 1 ran out of ranks
		} else if ($j < 0 && $i >= 0) {
			return -1;
		}
		return 0;
	}
}

// Provided test cases:
// $hands = Factory::createHandsFromEulerString("5H 5C 6S 7S KD 2C 3S 8S 8D TD");
// var_dump($hands[0]->compareTo($hands[1])); // 1
// $hands = Factory::createHandsFromEulerString("5D 8C 9S JS AC 2C 5C 7D 8S QH");
// var_dump($hands[0]->compareTo($hands[1])); // -1
// $hands = Factory::createHandsFromEulerString("2D 9C AS AH AC 3D 6D 7D TD QD");
// var_dump($hands[0]->compareTo($hands[1])); // 1
// $hands = Factory::createHandsFromEulerString("4D 6S 9H QH QC 3D 6D 7H QD QS");
// var_dump($hands[0]->compareTo($hands[1])); // -1
// $hands = Factory::createHandsFromEulerString("2H 2D 4C 4D 4S 3C 3D 3S 9S 9D");
// var_dump($hands[0]->compareTo($hands[1])); // -1

// actual code that gets the problem solved

$hands = Factory::createNestedArraysFromEulerFile("../hands.txt");

$numWonByP1 = 0;

foreach ($hands as $game) {
    if (PokerHand::compare($game[0], $game[1]) == -1) {
        $numWonByP1++;
    }
}

var_dump($numWonByP1);
