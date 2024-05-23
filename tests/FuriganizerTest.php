<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Wijourdil\PhpSimpleFuriganizer\Furiganizer;

class FuriganizerTest extends TestCase
{
    #[Test]
    #[DataProvider('provideData')]
    public function it_can_generate_furiganized_strings(string $characters, string $reading, string $expected_brackets, string $expected_html)
    {
        $furiganizer = new Furiganizer($characters, $reading);

        $this->assertEquals(
            $expected_brackets,
            $furiganizer->toBrackets(),
            'The brackets string does not match.'
        );

        $this->assertEquals(
            $expected_html,
            $furiganizer->toHtml(),
            'The html string does not match.'
        );
    }

    public static function provideData()
    {
        return [
            [
                'characters' => '',
                'reading' => '',
                'expected_brackets' => '',
                'expected_html' => '<ruby></ruby>',
            ],
            [
                'characters' => 'ここ',
                'reading' => 'ここ',
                'expected_brackets' => 'ここ',
                'expected_html' => '<ruby>ここ</ruby>',
            ],
            [
                'characters' => 'メイド',
                'reading' => 'メイド',
                'expected_brackets' => 'メイド',
                'expected_html' => '<ruby>メイド</ruby>',
            ],
            [
                'characters' => 'ドイツ',
                'reading' => 'どいつ',
                'expected_brackets' => 'ドイツ[どいつ]',
                'expected_html' => '<ruby>ドイツ<rp>(</rp><rt>どいつ</rt><rp>)</rp></ruby>',
            ],
            [
                'characters' => '知る',
                'reading' => '',
                'expected_brackets' => '知る',
                'expected_html' => '<ruby>知る</ruby>',
            ],
            [
                'characters' => '漢字',
                'reading' => '漢字',
                'expected_brackets' => '漢字',
                'expected_html' => '<ruby>漢字</ruby>',
            ],
            [
                'characters' => 'お手洗い',
                'reading' => 'お手洗い',
                'expected_brackets' => 'お手洗い',
                'expected_html' => '<ruby>お手洗い</ruby>',
            ],
            [
                'characters' => '',
                'reading' => 'いろ',
                'expected_brackets' => '',
                'expected_html' => '<ruby></ruby>',
            ],
            [
                'characters' => '入る',
                'reading' => 'はいる',
                'expected_brackets' => '入[はい]る',
                'expected_html' => '<ruby>入<rp>(</rp><rt>はい</rt><rp>)</rp>る</ruby>',
            ],
            [
                'characters' => '役に立つ',
                'reading' => 'やくにたつ',
                'expected_brackets' => '役[やく]に 立[た]つ',
                'expected_html' => '<ruby>役<rp>(</rp><rt>やく</rt><rp>)</rp>に</ruby><ruby>立<rp>(</rp><rt>た</rt><rp>)</rp>つ</ruby>',
            ],
            [
                'characters' => '出来上がる',
                'reading' => 'できあがる',
                'expected_brackets' => '出来上[できあ]がる',
                'expected_html' => '<ruby>出来上<rp>(</rp><rt>できあ</rt><rp>)</rp>がる</ruby>',
            ],
            [
                'characters' => '召し上がる',
                'reading' => 'めしあがる',
                'expected_brackets' => '召[め]し 上[あ]がる',
                'expected_html' => '<ruby>召<rp>(</rp><rt>め</rt><rp>)</rp>し</ruby><ruby>上<rp>(</rp><rt>あ</rt><rp>)</rp>がる</ruby>',
            ],
            [
                'characters' => '掛かる',
                'reading' => 'かかる',
                'expected_brackets' => '掛[か]かる',
                'expected_html' => '<ruby>掛<rp>(</rp><rt>か</rt><rp>)</rp>かる</ruby>',
            ],
            [
                'characters' => '兄弟',
                'reading' => 'きょうだい',
                'expected_brackets' => '兄弟[きょうだい]',
                'expected_html' => '<ruby>兄弟<rp>(</rp><rt>きょうだい</rt><rp>)</rp></ruby>',
            ],
            [
                'characters' => '雨',
                'reading' => 'あめ',
                'expected_brackets' => '雨[あめ]',
                'expected_html' => '<ruby>雨<rp>(</rp><rt>あめ</rt><rp>)</rp></ruby>',
            ],
            [
                'characters' => 'この男の人は独身だ',
                'reading' => 'このおとこのひとはどくしんだ',
                'expected_brackets' => 'この 男[おとこ]の 人[ひと]は 独身[どくしん]だ',
                'expected_html' => '<ruby>この</ruby><ruby>男<rp>(</rp><rt>おとこ</rt><rp>)</rp>の</ruby><ruby>人<rp>(</rp><rt>ひと</rt><rp>)</rp>は</ruby><ruby>独身<rp>(</rp><rt>どくしん</rt><rp>)</rp>だ</ruby>',
            ],
            [
                'characters' => 'お知らせ',
                'reading' => 'おしらせ',
                'expected_brackets' => 'お 知[し]らせ',
                'expected_html' => '<ruby>お</ruby><ruby>知<rp>(</rp><rt>し</rt><rp>)</rp>らせ</ruby>',
            ],
            [
                'characters' => '今日',
                'reading' => '明日',
                'expected_brackets' => '今日[明日]',
                'expected_html' => '<ruby>今日<rp>(</rp><rt>明日</rt><rp>)</rp></ruby>',
            ],
            [
                'characters' => '三番ホーム',
                'reading' => 'さんばんホーム',
                'expected_brackets' => '三番ホーム[さんばんホーム]',
                'expected_html' => '<ruby>三番ホーム<rp>(</rp><rt>さんばんホーム</rt><rp>)</rp></ruby>',
            ],
            [
                'characters' => '一番ホーム',
                'reading' => 'いちばんほーむ',
                'expected_brackets' => '一番ホーム[いちばんほーむ]',
                'expected_html' => '<ruby>一番ホーム<rp>(</rp><rt>いちばんほーむ</rt><rp>)</rp></ruby>',
            ],
        ];
    }
}