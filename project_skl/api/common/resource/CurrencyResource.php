<?php

namespace api\common\resource;

use app\models\currency\Currency;

class CurrencyResource extends Currency
{
    public function fields(): array
    {
        return [
            'id',
            'name',
            'rate',
        ];
    }
}
