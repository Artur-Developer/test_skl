<?php

namespace api\common\controllers;

use api\common\enums\StatusCode;
use yii\base\ExitException;
use Yii;
use yii\httpclient\Client;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * @OA\OpenApi(
 *     @OA\Server(
 *         url="http://project_skl.localhost:81",
 *         description="LOCAL currency API",
 *     ),
 *     @OA\Info(
 *         version="1.0",
 *         title="Currency API",
 *         description="Currency data",
 *         @OA\Contact(name="Currency"),
 *     ),
 *)
 * @OA\Schema(
 *   schema="Currency",
 *     @OA\Property(property="id", type="int"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="rate", type="number"),
 * )
 *
 * @class BaseController for API
 */
class BaseController extends ActiveController
{
    public const MAX_DATA_ON_PAGE = 50;

    public int $runTimeAction;
    public Client $client;

    /**
     * @param $action
     * @return bool
     * @throws ExitException
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        $this->runTimeAction =  microtime(true);;
        $this->enableCsrfValidation = false;

        \Yii::$app->response->headers->set('Access-Control-Allow-Origin', '*');
        \Yii::$app->response->headers->set('Access-Control-Allow-Headers', 'Authorization,Origin,Content-Type,Accept,Www-Authenticate,Host,Sec-*,X-Auth-Token');
        \Yii::$app->response->headers->set('Access-Control-Allow-Method', 'OPTIONS,HEAD,GET,POST,PUT,DELETE');
        \Yii::$app->response->headers->set('Access-Control-Allow-Methods', 'OPTIONS,HEAD,GET,POST,PUT,DELETE');
        \Yii::$app->response->headers->set('Access-Control-Expose-Headers', '*');

        if (\Yii::$app->getRequest()->getMethod() === 'OPTIONS')
        {
            \Yii::$app->getResponse()->getHeaders()->set('Allow', 'OPTIONS,HEAD,GET,POST,PUT,DELETE');
            \Yii::$app->response->format = Response::FORMAT_RAW;
            \Yii::$app->getResponse()->data = null;
            \Yii::$app->end();
        }
        if ($language = \Yii::$app->request->headers->get('Accept-Language'))
        {
            \Yii::$app->language = $language;
        }

        return parent::beforeAction($action);
    }

    /**
     * @param $action
     * @param $result
     * @return mixed
     */
    /**
     * {@inheritdoc}
     */
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        return $this->serializeData($result);
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return parent::behaviors();
    }

    /**
     * @param int $code
     * @param string $message
     * @param mixed $data
     * @param mixed $debug
     * @return array
     */
    public function response(int $code = StatusCode::SUCCESS, string $message = '', $data = [], $debug = ''): array
    {
        Yii::$app->response->statusCode = $code;

        return [
            'code' => $code,
            'message' => $message,
            'runTimeAction' => round(microtime(true) - $this->runTimeAction, 2),
            'data' => $data,
            'debug' => YII_DEBUG ? $debug : ''
        ];
    }

    /**
     * @return array
     */
    public function actions(): array
    {
        return [];
    }
}