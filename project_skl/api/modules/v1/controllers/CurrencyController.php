<?php

namespace api\modules\v1\controllers;

use api\common\controllers\BaseController;
use api\common\enums\StatusCode;
use api\modules\v1\models\currency\ApiCurrency;
use app\services\currency\CurrencyService;
use Yii;
use yii\db\ActiveRecord;

class CurrencyController extends BaseController
{
    /** @var ApiCurrency $modelClass */
    public $modelClass = ApiCurrency::class;

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
     * @OA\Get(
     *     path="/v1/currencies",
     *     description="Returns query currency list",
     *     tags={"currencies"},
     *      @OA\Parameter(
     *      in="header",
     *      name="Accept-Language",
     *      description="To select a language, the header content had to be provided 'ru-RU', 'en-US'",
     *      @OA\Schema(
     *          type="string",
     *          default="ru-RU",
     *      )
     *),
     *     @OA\Parameter(
     *         in="query",
     *         name="per_page",
     *         description="Number of items per page",
     *         @OA\Schema(
     *             type="integer",
     *             default=50,
     *         )
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="page",
     *         description="Page number",
     *         @OA\Schema(
     *             type="integer",
     *             default=0,
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *     )
     * )
     * @return array|ActiveRecord[]
     */
    public function actionIndex(): array
    {
        $perPage = Yii::$app->request->get('per_page', $this::MAX_DATA_ON_PAGE);
        $page = Yii::$app->request->get('page', 0);

        return $this->response(StatusCode::SUCCESS,
            Yii::t('app', 'Returns query currency list'),
            $this->currencyService->getAll($perPage, $page)
        );
    }

    /**
     * @OA\Get(
     *     path="/v1/currency/{name}",
     *     description="Return query currency by name",
     *     tags={"currencies"},
     *     @OA\Parameter(
     *         in="path",
     *         name="name",
     *         required=true,
     *         description="Currency name for search",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         in="header",
     *         name="Accept-Language",
     *         description="To select a language, the header content had to be provided 'ru-RU', 'en-US'",
     *         @OA\Schema(
     *             type="string",
     *             default="ru-RU",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Currency not found",
     *     ),
     * )
     * @param string $name
     * @return array
     */
    public function actionRate(string $name): array
    {
        $data = $this->currencyService->getRateByName($name);

        if (is_null($data)) {
            return $this->response(
                StatusCode::NOT_FOUND,
                Yii::t('app', 'Currency not found')
            );
        }

        return $this->response(StatusCode::SUCCESS,
            Yii::t('app', 'Rate now'),
            $data
        );
    }
}
