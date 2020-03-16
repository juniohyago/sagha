<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%aula_professor}}".
 *
 * @property int $aula_id
 * @property int $professor_id
 *
 * @property Aula $aula
 * @property Professor $professor
 */
class AulaProfessor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%aula_professor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aula_id', 'professor_id'], 'required'],
            [['aula_id', 'professor_id'], 'integer'],
            [['aula_id', 'professor_id'], 'unique', 'targetAttribute' => ['aula_id', 'professor_id']],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::className(), 'targetAttribute' => ['aula_id' => 'id']],
            [['professor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['professor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aula_id' => 'Aula ID',
            'professor_id' => 'Professor ID',
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
     * Gets query for [[Professor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfessor()
    {
        return $this->hasOne(Professor::className(), ['id' => 'professor_id']);
    }
}
