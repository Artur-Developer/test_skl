<?php

namespace app\services\currency;

interface CurrencyServiceInterface
{
    /**
     * @return mixed
     */
    public function updateCurrencies();

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param string $name
     * @return mixed
     */
    public function getRateByName(string $name);

}