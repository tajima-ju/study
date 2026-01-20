<?php

declare(strict_types=1);

namespace Decodeing;

spl_autoload_register(function ($class) {
    require __DIR__ . "\{$class}.php";
    echo __DIR__ . "\{$class}.php";
});

$character_date = new CharacterDate("");
//クラスことにファイル分割、オートーロード