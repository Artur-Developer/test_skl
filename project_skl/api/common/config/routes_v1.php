<?php

return [
    // currencies
    'GET v1/currencies' => 'v1/currency/index',
    'GET v1/currency/<name:\w+>' => 'v1/currency/rate',
];