<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%disciplinas_disponiveis_professor}}".
 *
 * @property int $disciplinas_disponiveis_id
 * @property int $professor_id
 *
 * @property DisciplinasDisponiveis $disciplinasDisponiveis
 * @property Professor $professor
 */
class DisciplinasDisponiveisProfessor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%disciplinas_disponiveis_professor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['disciplinas_disponiveis_id', 'professor_id'], 'required'],
            [['disciplinas_disponiveis_id', 'professor_id'], 'integer'],
            [['disciplinas_disponiveis_id', 'professor_id'], 'unique', 'targetAttribute' => ['disciplinas_disponiveis_id', 'professor_id']],
            [['disciplinas_disponiveis_id'], 'exist', 'skipOnError' => true, 'targetClass' => DisciplinasDisponiveis::className(), 'targetAttribute' => ['disciplinas_disponiveis_id' => 'id']],
            [['professor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['professor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'disciplinas_disponiveis_id' => 'Disciplinas Disponiveis ID',
            'professor_id' => 'Professor ID',
        ];
    }

    /**
     * Gets query for [[DisciplinasDisponiveis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinasDisponiveis()
    {
        return $this->hasOne(DisciplinasDisponiveis::className(), ['id' => 'disciplinas_disponiveis_id']);
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
