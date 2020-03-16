<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%turmas}}".
 *
 * @property int $id
 * @property string $descricao
 * @property string $periodo
 * @property int $fk_curso_id
 *
 * @property Curso $fkCurso
 */
class Turma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%turmas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'periodo', 'fk_curso_id'], 'required'],
            [['fk_curso_id'], 'integer'],
            [['descricao', 'periodo'], 'string', 'max' => 255],
            [['fk_curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['fk_curso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'periodo' => 'Periodo',
            'fk_curso_id' => 'Fk Curso ID',
        ];
    }

    /**
     * Gets query for [[FkCurso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCurso()
    {
        return $this->hasOne(Curso::className(), ['id' => 'fk_curso_id']);
    }
}
