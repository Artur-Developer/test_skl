<?php

namespace app\components\currency;

use app\models\currency\Currency;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;

class CurrencyUpdater extends Component implements CurrencyUpdaterInterface
{
    /**
     * @var string
     */
    public string $url_currency_list = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @return void
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function updateCurrencies()
    {
        $client = new Client();
        $response = $client->createRequest()->setMethod('GET')->setUrl($this->url_currency_list)->send();

        if ($response->isOk) {
            $data = simplexml_load_string($response->content);
            $this->updateCurrencyData($data);
        } else {
            Yii::error("Error fetching data from CBR: " . $response->content);
        }
    }

    /**
     * @param $data
     * @return void
     */
    protected function updateCurrencyData($data)
    {
        foreach ($data->Valute as $currency) {
            $this->updateSingleCurrency((string)$currency->CharCode, (float)str_replace(',', '.', (string)$currency->Value));
        }
    }

    /**
     * @param $name
     * @param $rate
     * @return void
     */
    protected function updateSingleCurrency($name, $rate)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        try {
            $currency = Currency::findOne(['name' => $name]);
            if (!$currency) {
                $currency = new Currency();
                $currency->name = $name;
            }

            $currency->rate = $rate;
            $currency->save();

            $transaction->commit();
            Yii::info("Currency data updated successfully for {$name}.");
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error("Error updating currency data for {$name}: " . $e->getMessage());
        }
    }
}
