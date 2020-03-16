<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%disciplinas_disponiveis_curso}}".
 *
 * @property int $disciplinas_disponiveis_id
 * @property int $curso_id
 *
 * @property Curso $curso
 * @property DisciplinasDisponivei $disciplinasDisponiveis
 */
class DisciplinasDisponiveisCurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%disciplinas_disponiveis_curso}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['disciplinas_disponiveis_id', 'curso_id'], 'required'],
            [['disciplinas_disponiveis_id', 'curso_id'], 'integer'],
            [['disciplinas_disponiveis_id', 'curso_id'], 'unique', 'targetAttribute' => ['disciplinas_disponiveis_id', 'curso_id']],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso_id' => 'id']],
            [['disciplinas_disponiveis_id'], 'exist', 'skipOnError' => true, 'targetClass' => DisciplinasDisponivei::className(), 'targetAttribute' => ['disciplinas_disponiveis_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'disciplinas_disponiveis_id' => 'Disciplinas Disponiveis ID',
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
     * Gets query for [[DisciplinasDisponiveis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinasDisponiveis()
    {
        return $this->hasOne(DisciplinasDisponivei::className(), ['id' => 'disciplinas_disponiveis_id']);
    }
}
