<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%disciplinas_disponiveis}}".
 *
 * @property int $id
 * @property string $descricao
 * @property int $carga_horaria
 *
 * @property Aula[] $aulas
 * @property DisciplinasDisponiveisCurso[] $disciplinasDisponiveisCursos
 * @property Curso[] $cursos
 * @property DisciplinasDisponiveisProfessor[] $disciplinasDisponiveisProfessors
 * @property Professor[] $professors
 */
class DisciplinasDisponivei extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%disciplinas_disponiveis}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'carga_horaria'], 'required'],
            [['carga_horaria'], 'integer'],
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
            'descricao' => 'Descricao',
            'carga_horaria' => 'Carga Horaria',
        ];
    }

    /**
     * Gets query for [[Aulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::className(), ['fk_disciplinas_disponiveis_id' => 'id']);
    }

    /**
     * Gets query for [[DisciplinasDisponiveisCursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinasDisponiveisCursos()
    {
        return $this->hasMany(DisciplinasDisponiveisCurso::className(), ['disciplinas_disponiveis_id' => 'id']);
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::className(), ['id' => 'curso_id'])->viaTable('{{%disciplinas_disponiveis_curso}}', ['disciplinas_disponiveis_id' => 'id']);
    }

    /**
     * Gets query for [[DisciplinasDisponiveisProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinasDisponiveisProfessors()
    {
        return $this->hasMany(DisciplinasDisponiveisProfessor::className(), ['disciplinas_disponiveis_id' => 'id']);
    }

    /**
     * Gets query for [[Professors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfessors()
    {
        return $this->hasMany(Professor::className(), ['id' => 'professor_id'])->viaTable('{{%disciplinas_disponiveis_professor}}', ['disciplinas_disponiveis_id' => 'id']);
    }
}