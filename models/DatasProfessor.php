<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%datas_professor}}".
 *
 * @property int $datas_id
 * @property int $professor_id
 *
 * @property Datas $datas
 * @property Professor $professor
 */
class DatasProfessor extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%datas_professor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datas_id', 'professor_id'], 'required'],
            [['datas_id', 'professor_id'], 'integer'],
            [['datas_id', 'professor_id'], 'unique', 'targetAttribute' => ['datas_id', 'professor_id']],
            [['datas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Datas::className(), 'targetAttribute' => ['datas_id' => 'id']],
            [['professor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['professor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'datas_id' => 'Datas ID',
            'professor_id' => 'Professor ID',
        ];
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

    /**
     * Gets query for [[Professor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfessor()
    {
        return $this->hasOne(Professor::className(), ['id' => 'professor_id']);
    }
}
