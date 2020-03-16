<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%professor}}".
 *
 * @property int $id
 * @property string $cpf
 * @property string $nome
 * @property string $sobreNome
 * @property string $titulacao
 * @property float $valor_hora_aula
 *
 * @property AulaProfessor[] $aulaProfessors
 * @property Aula[] $aulas
 * @property DatasProfessorProfessor[] $datasProfessorProfessors
 * @property DatasProfessor[] $datasProfessors
 * @property DisciplinasDisponiveisProfessor[] $disciplinasDisponiveisProfessors
 * @property DisciplinasDisponivei[] $disciplinasDisponiveis
 */
class Professor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%professor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cpf', 'nome', 'sobreNome', 'titulacao', 'valor_hora_aula'], 'required'],
            [['valor_hora_aula'], 'number'],
            [['cpf'], 'string', 'max' => 12],
            [['nome', 'sobreNome', 'titulacao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cpf' => 'Cpf',
            'nome' => 'Nome',
            'sobreNome' => 'Sobre Nome',
            'titulacao' => 'Titulacao',
            'valor_hora_aula' => 'Valor Hora Aula',
        ];
    }

    /**
     * Gets query for [[AulaProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulaProfessors()
    {
        return $this->hasMany(AulaProfessor::className(), ['professor_id' => 'id']);
    }

    /**
     * Gets query for [[Aulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::className(), ['id' => 'aula_id'])->viaTable('{{%aula_professor}}', ['professor_id' => 'id']);
    }

    /**
     * Gets query for [[DatasProfessorProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatasProfessorProfessors()
    {
        return $this->hasMany(DatasProfessorProfessor::className(), ['professor_id' => 'id']);
    }

    /**
     * Gets query for [[DatasProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatasProfessors()
    {
        return $this->hasMany(DatasProfessor::className(), ['id' => 'datas_professor_id'])->viaTable('{{%datas_professor_professor}}', ['professor_id' => 'id']);
    }

    /**
     * Gets query for [[DisciplinasDisponiveisProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinasDisponiveisProfessors()
    {
        return $this->hasMany(DisciplinasDisponiveisProfessor::className(), ['professor_id' => 'id']);
    }

    /**
     * Gets query for [[DisciplinasDisponiveis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinasDisponiveis()
    {
        return $this->hasMany(DisciplinasDisponivei::className(), ['id' => 'disciplinas_disponiveis_id'])->viaTable('{{%disciplinas_disponiveis_professor}}', ['professor_id' => 'id']);
    }
}
