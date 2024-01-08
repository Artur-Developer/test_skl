<?php

namespace app\services\currency;

use api\common\resource\CurrencyRateResource;
use api\common\resource\CurrencyResource;
use app\components\currency\CurrencyUpdater;
use app\models\currency\Currency;
use yii\base\InvalidConfigException;
use yii\httpclient\Exception;

class CurrencyService implements CurrencyServiceInterface
{
    /**
     * @var CurrencyUpdater
     */
    private CurrencyUpdater $currencyUpdater;

    /**
     * @param CurrencyUpdater $currencyUpdater
     */
    public function __construct(CurrencyUpdater $currencyUpdater)
    {
        $this->currencyUpdater = $currencyUpdater;
    }

    /**
     * @return void
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function updateCurrencies()
    {
        $this->currencyUpdater->updateCurrencies();
    }

    /**
     * @param int $perPage
     * @param int $page
     * @return array
     */
    public function getAll(int $perPage = 0, int $page = 0): array
    {
        return CurrencyResource::find()
            ->limit($perPage)
            ->offset($page)
            ->all();
    }

    /**
     * @param string $name
     * @return Currency|null
     */
    public function getRateByName(string $name): ?Currency
    {
        return CurrencyRateResource::findOne(['name' => $name]);
    }
}