<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%aula}}".
 *
 * @property int $id
 * @property int $fk_disciplinas_disponiveis_id
 * @property int $fk_turmas_id
 * @property string $dataHora_inicio
 * @property string $dataHora_fim
 *
 * @property DisciplinasDisponivei $fkDisciplinasDisponiveis
 * @property AulaProfessor[] $aulaProfessors
 * @property Professor[] $professors
 */
class Aula extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%aula}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_disciplinas_disponiveis_id', 'fk_turmas_id', 'dataHora_inicio', 'dataHora_fim'], 'required'],
            [['fk_disciplinas_disponiveis_id', 'fk_turmas_id'], 'integer'],
            [['dataHora_inicio', 'dataHora_fim'], 'safe'],
            [['fk_disciplinas_disponiveis_id'], 'exist', 'skipOnError' => true, 'targetClass' => DisciplinasDisponivei::className(), 'targetAttribute' => ['fk_disciplinas_disponiveis_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_disciplinas_disponiveis_id' => 'Fk Disciplinas Disponiveis ID',
            'fk_turmas_id' => 'Fk Turmas ID',
            'dataHora_inicio' => 'Data Hora Inicio',
            'dataHora_fim' => 'Data Hora Fim',
        ];
    }

    /**
     * Gets query for [[FkDisciplinasDisponiveis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkDisciplinasDisponiveis()
    {
        return $this->hasOne(DisciplinasDisponivei::className(), ['id' => 'fk_disciplinas_disponiveis_id']);
    }

    /**
     * Gets query for [[AulaProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulaProfessors()
    {
        return $this->hasMany(AulaProfessor::className(), ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[Professors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfessors()
    {
        return $this->hasMany(Professor::className(), ['id' => 'professor_id'])->viaTable('{{%aula_professor}}', ['aula_id' => 'id']);
    }
}
