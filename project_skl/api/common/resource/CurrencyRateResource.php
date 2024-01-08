<?php

namespace api\common\resource;

use app\models\currency\Currency;

class CurrencyRateResource extends Currency
{
    public function fields(): array
    {
        return [
            'rate',
        ];
    }
}
