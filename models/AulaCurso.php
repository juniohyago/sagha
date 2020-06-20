<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%aula_curso}}".
 *
 * @property int $aula_id
 * @property int $curso_id
 *
 * @property Aula $aula
 * @property Curso $curso
 */
class AulaCurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%aula_curso}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aula_id', 'curso_id'], 'required'],
            [['aula_id', 'curso_id'], 'integer'],
            [['aula_id', 'curso_id'], 'unique', 'targetAttribute' => ['aula_id', 'curso_id']],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::className(), 'targetAttribute' => ['aula_id' => 'id']],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aula_id' => 'Aula ID',
            'curso_id' => 'Curso ID',
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
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Curso::className(), ['id' => 'curso_id']);
    }
}
