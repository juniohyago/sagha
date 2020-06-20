<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%datas_aula}}".
 *
 * @property int $datas_id
 * @property int $aula_id
 *
 * @property Aula $aula
 * @property Datas $datas
 */
class DatasAula extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%datas_aula}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datas_id', 'aula_id'], 'required'],
            [['datas_id', 'aula_id'], 'integer'],
            [['datas_id', 'aula_id'], 'unique', 'targetAttribute' => ['datas_id', 'aula_id']],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::className(), 'targetAttribute' => ['aula_id' => 'id']],
            [['datas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Datas::className(), 'targetAttribute' => ['datas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'datas_id' => 'Datas ID',
            'aula_id' => 'Aula ID',
        ];
    }

    /**
     * Gets query for [[Aula]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAula()
    {
        return $this->hasOne(Aula::className(), ['id' => 'aula_id']);
    }

    /**
     * Gets query for [[Datas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatas()
    {
        return $this->hasOne(Datas::className(), ['id' => 'datas_id']);
    }
}
