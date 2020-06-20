<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%unidade}}".
 *
 * @property int $id
 * @property string $descricao
 *
 * @property UnidadeCurso[] $unidadeCursos
 * @property Curso[] $cursos
 */
class Unidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%unidade}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
        ];
    }

    /**
     * Gets query for [[UnidadeCursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadeCursos()
    {
        return $this->hasMany(UnidadeCurso::className(), ['unidade_id' => 'id']);
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::className(), ['id' => 'curso_id'])->viaTable('{{%unidade_curso}}', ['unidade_id' => 'id']);
    }
}
