<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%unidade_curso}}".
 *
 * @property int $unidade_id
 * @property int $curso_id
 *
 * @property Curso $curso
 * @property Unidade $unidade
 */
class UnidadeCurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%unidade_curso}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unidade_id', 'curso_id'], 'required'],
            [['unidade_id', 'curso_id'], 'integer'],
            [['unidade_id', 'curso_id'], 'unique', 'targetAttribute' => ['unidade_id', 'curso_id']],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso_id' => 'id']],
            [['unidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unidade::className(), 'targetAttribute' => ['unidade_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unidade_id' => 'Unidade ID',
            'curso_id' => 'Curso ID',
        ];
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

    /**
     * Gets query for [[Unidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnidade()
    {
        return $this->hasOne(Unidade::className(), ['id' => 'unidade_id']);
    }
}
