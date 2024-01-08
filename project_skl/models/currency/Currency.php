<?php

namespace app\models\currency;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $name
 * @property float $rate
 */
class Currency extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'rate'], 'required'],
            [['rate'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'rate' => Yii::t('app', 'Rate'),
        ];
    }
}
