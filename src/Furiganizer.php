<?php

namespace Wijourdil\PhpSimpleFuriganizer;

use function Safe\preg_split;

class Furiganizer
{
    private const array HIRAGANA = [
        'あ', 'い', 'う', 'え', 'お',
        'ぁ', 'ぃ', 'ぅ', 'ぇ', 'ぉ',
        'か', 'き', 'く', 'け', 'こ',
        'が', 'ぎ', 'ぐ', 'げ', 'ご',
        'さ', 'し', 'す', 'せ', 'そ',
        'ざ', 'じ', 'ず', 'ぜ', 'ぞ',
        'ら', 'り', 'る', 'れ', 'ろ',
        'な', 'に', 'ぬ', 'ね', 'の',
        'た', 'ち', 'つ', 'て', 'と',
        'だ', 'ぢ', 'づ', 'で', 'ど',
        'ま', 'み', 'む', 'め', 'も',
        'は', 'ひ', 'ふ', 'へ', 'ほ',
        'ば', 'び', 'ぶ', 'べ', 'ぼ',
        'ぱ', 'ぴ', 'ぷ', 'ぺ', 'ぽ',
        'や', 'よ', 'ゆ',
        'ん', 'わ', 'を', 'っ',
        'きゃ', 'きゅ', 'きょ',
        'ぎゃ', 'ぎゅ', 'ぎょ',
        'しゃ', 'しゅ', 'しょ',
        'じゃ', 'じゅ', 'じょ',
        'りゃ', 'りゅ', 'りょ',
        'にゃ', 'にゅ', 'にょ',
        'みゃ', 'みゅ', 'みょ',
        'ちゃ', 'ちゅ', 'ちょ',
        'ひゃ', 'ひゅ', 'ひょ',
        'びゃ', 'びゅ', 'びょ',
        'ぴゃ', 'ぴゅ', 'ぴょ',
    ];

    private string $furiganizedString;

    public function __construct(private readonly string $characters, private readonly string $reading)
    {
        if (empty($this->reading) || empty($this->characters) || $this->characters == $this->reading) {
            $this->furiganizedString = $this->characters;
        } else {
            $this->furiganizedString = $this->calculateFuriganizedString();
        }
    }

    public function toBrackets(): string
    {
        return $this->furiganizedString;
    }

    public function toHtml(): string
    {
        $html = $this->furiganizedString;

        $html = str_replace('[', '<rp>(</rp><rt>', $html);
        $html = str_replace(']', '</rt><rp>)</rp>', $html);
        $html = str_replace(' ', '</ruby><ruby>', $html);

        return "<ruby>{$html}</ruby>";
    }

    private function calculateFuriganizedString(): string
    {
        $finalString = '';

        $charactersSplittedByHiragana = array_filter(preg_split(
            pattern: '/(' . join('|', self::HIRAGANA) . ')/u',
            subject: $this->characters,
            flags: PREG_SPLIT_DELIM_CAPTURE
        ));
        $readingsCharByChar = array_filter(preg_split('//u', $this->reading));

        while (!empty($readingsCharByChar)) {
            $currentCharactersGroup = array_shift($charactersSplittedByHiragana);
            $currentReadingElement = array_shift($readingsCharByChar);

            if ($currentCharactersGroup == $currentReadingElement) {
                $finalString .= $currentReadingElement;
            } else {
                $spaceDelimiter = (empty($finalString)) ? '' : ' ';
                $readingForCurrentCharactersGroup = $currentReadingElement;

                if (empty($charactersSplittedByHiragana)) {
                    $remainingReading = join('', $readingsCharByChar);
                    $readingsCharByChar = [];
                    $finalString .= "{$spaceDelimiter}{$currentCharactersGroup}[{$currentReadingElement}{$remainingReading}]";
                } else {
                    while (!empty($readingsCharByChar) && $readingsCharByChar[0] != $charactersSplittedByHiragana[0]) {
                        $currentReadingElement = array_shift($readingsCharByChar);
                        $readingForCurrentCharactersGroup .= $currentReadingElement;
                    }

                    $finalString .= "{$spaceDelimiter}{$currentCharactersGroup}[{$readingForCurrentCharactersGroup}]";
                }
            }
        }

        return $finalString;
    }
}