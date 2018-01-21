<?php
/**
 * Вы решили написать библиотеку, которая будет принимать строку вида:
 * (()()()()))((((()()()))(()()()(((()))))))
 * И возвращать true, если строка корректна – все открытые скобки корректно открыты
 * и закрыты, или же false в противном случае.
 * Строка может включать символы “(“, “)”, “ ” (пробел), “\n” (перенос строки), “\t” (символ
 * табуляции), “\r” (перенос каретки). Если же строка содержит что-то кроме
 * перечисленных символов, то ваша библиотека должна выбрасывать исключение
 * InvalidArgumentException.
 * Ограничения на длину строки нет.
 */
declare(strict_types = 1);

namespace Sden81;

class BracketCalc
{
    private $_stack = []; //стэк для скобок
    private $inputText; //анализируемый текст
    private $_avaliableSymbols = ["(", ")", " ", "\n", "\r", "\t"]; //допустимые символы

    /**
     * BracketCalc constructor.
     * @param $inputText
     */
    public function __construct($inputText = "")
    {
        if (!empty($inputText))
            $this->inputText = $inputText;
    }

    /**
     * @return bool
     * Анализируем текст на предмет правильного открытия и закрытия скобок
     */
    public function analyzeThis():bool
    {
        //проверяем текст на допустимые символы
        if (!$this->validateText() || empty($this->inputText))
            throw new \InvalidArgumentException('Invalid symbols or empty text');

        $i = -1;
        while ($i++ < strlen($this->inputText) - 1) {
            if ($this->inputText[$i] === "(" || $this->inputText[$i] === ")")
                if (!$this->addBracketToStack($this->inputText[$i]))
                    return false;
        }

        return $this->isEmptyBracketStack();
    }

    /**
     * @param $bracket
     * @return bool
     * стек скобок
     * если добавлять открывающую скобку - она добавиться
     * если добавлять закрывающую скобку - она не добавиться, а удалит открывающую, добавленную ранее
     * если добавлять закрывающую скобку при отсутствии открывающей вернет false
     * во всех
     */
    private function addBracketToStack($bracket):bool
    {
        switch ($bracket) {
            case "(":
                array_push($this->_stack, $bracket);
                break;
            case ")":
                if (count($this->_stack)) {
                    array_pop($this->_stack);
                } else {
                    return false;
                }
        }
        return true;
    }

    /**
     * @return bool
     * пуст ли стек скобок,
     * если пуст, то проверка успешна
     */
    private function isEmptyBracketStack():bool
    {
        return (count($this->_stack)) ? false : true;
    }

    /**
     * @return bool
     * проверяет символы текста на валидность
     */
    private function validateText():bool
    {
        $text = $this->inputText;
        foreach ($this->_avaliableSymbols as $item) {
            $text = str_replace($item, "", $text);
        }

        return (!$text) ? true : false;
    }

    /**
     * @param mixed $inputText
     */
    public function setInputText($inputText)
    {
        $this->inputText = $inputText;
    }

    /**
     * @return string
     */
    public function getInputText():string
    {
        return $this->inputText;
    }
}