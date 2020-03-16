<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%datas_professor_professor}}".
 *
 * @property int $datas_professor_id
 * @property int $professor_id
 *
 * @property DatasProfessor $datasProfessor
 * @property Professor $professor
 */
class DatasProfessorProfessor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%datas_professor_professor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datas_professor_id', 'professor_id'], 'required'],
            [['datas_professor_id', 'professor_id'], 'integer'],
            [['datas_professor_id', 'professor_id'], 'unique', 'targetAttribute' => ['datas_professor_id', 'professor_id']],
            [['datas_professor_id'], 'exist', 'skipOnError' => true, 'targetClass' => DatasProfessor::className(), 'targetAttribute' => ['datas_professor_id' => 'id']],
            [['professor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['professor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'datas_professor_id' => 'Datas Professor ID',
            'professor_id' => 'Professor ID',
        ];
    }

    /**
     * Gets query for [[DatasProfessor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatasProfessor()
    {
        return $this->hasOne(DatasProfessor::className(), ['id' => 'datas_professor_id']);
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
