<?php


namespace Codenation\Cyphers;


class Cesar implements Cypher
{
    public $range = 0;
    public $string = 0;
    public $encrypted = "";
    public const ALPHABETICAL_RANGE = 26;

    public function __construct($range = 0, $string = '')
    {
        $this->range = $range;
        $this->string = $string;
    }

    public function encrypt()
    {
        $this->range = abs($this->range);
        $this->encrypted = "";
        foreach (str_split($this->string) as $letter) {
            $this->encrypted .= $this->shiftChar($letter);
        }
    }

    public function decrypt()
    {
        $this->encrypted = "";
        $this->range = abs($this->range) * -1;
        foreach (str_split($this->string) as $letter) {
            $this->encrypted .= $this->shiftChar($letter);
        }
    }

    private function shiftChar($char): string
    {
        $ordChar = ord($char);

        if (!$this->isAlphabetical($ordChar)) {
            return chr($ordChar);
        }

        $shiftedLetter = $ordChar + $this->range;
        if ($this->isOverAlphabetical($shiftedLetter)) {
            return chr($shiftedLetter - Cesar::ALPHABETICAL_RANGE);
        }

        if ($this->isUnderAlphabetical($shiftedLetter)) {
            return chr($shiftedLetter + Cesar::ALPHABETICAL_RANGE);
        }

        return chr($shiftedLetter);
    }

    private function isAlphabetical($ordChar)
    {
        return $ordChar >= 97 && $ordChar <= 122;
    }

    private function isOverAlphabetical($ordChar)
    {
        return $ordChar > 122;
    }

    private function isUnderAlphabetical($ordChar)
    {
        return $ordChar < 97;
    }
}
