<?php

namespace app\commands;

use app\services\currency\CurrencyService;
use yii\base\InvalidConfigException;
use yii\console\Controller;
use yii\httpclient\Exception;

class CurrencyController extends Controller
{
    /**
     * @var CurrencyService
     */
    private CurrencyService $currencyService;

    /**
     * @param $id
     * @param $module
     * @param CurrencyService $currencyService
     * @param array $config
     */
    public function __construct($id, $module, CurrencyService $currencyService, array $config = [])
    {
        $this->currencyService = $currencyService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return void
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function actionUpdate()
    {
        $this->currencyService->updateCurrencies();
    }
}
