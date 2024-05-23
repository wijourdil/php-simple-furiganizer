# PHP Simple Furiganizer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wijourdil/php-simple-furiganizer.svg)](https://packagist.org/packages/wijourdil/php-simple-furiganizer)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/wijourdil/php-simple-furiganizer/run-tests.yml?branch=main&label=tests)](https://github.com/wijourdil/php-simple-furiganizer/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/wijourdil/php-simple-furiganizer.svg)](https://packagist.org/packages/wijourdil/php-simple-furiganizer)

This package is a simple tool to generate japanese text with furigana for a given word and reading.

<pre style="font-size: 20px">
<ruby>雨の日<rp>(</rp><rt>Text</rt><rp>)</rp></ruby> + <ruby>あめのひ<rp>(</rp><rt>Reading</rt><rp>)</rp></ruby> &rArr; <ruby>雨<rp>(</rp><rt>あめ</rt><rp>)</rp>の</ruby><ruby>日<rp>(</rp><rt>ひ</rt><rp>)</rp></ruby>
</pre>

## Installation

Install the package via composer:

```bash
composer require wijourdil/php-simple-furiganizer
```

## Usage

First, simply import the `Furiganizer` class:

```php
use Wijourdil\PhpSimpleFuriganizer\Furiganizer;
```

Then, you just have to instantiate a new Furiganizer and generate the output in the format you want:

```php
$furiganizer = new Furiganizer('雨の日', 'あめのひ');

echo "Output in text is " . $furiganizer->toBrackets();
echo "Output in HTML is " . $furiganizer->toHtml();
```

Will output :

<pre>
Output in text is 雨[あめ]の 日[ひ]
Output in HTML is <ruby>雨<rp>(</rp><rt>あめ</rt><rp>)</rp>の</ruby><ruby>日<rp>(</rp><rt>ひ</rt><rp>)</rp></ruby>
</pre>
