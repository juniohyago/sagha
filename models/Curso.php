<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%curso}}".
 *
 * @property int $id
 * @property string $descricao
 * @property string $tipo_curso
 * @property int $fk_coordenador_id
 *
 * @property Coordenador $fkCoordenador
 * @property DisciplinasDisponiveisCurso[] $disciplinasDisponiveisCursos
 * @property DisciplinasDisponivei[] $disciplinasDisponiveis
 * @property Turma[] $turmas
 * @property UnidadeCurso[] $unidadeCursos
 * @property Unidade[] $unidades
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%curso}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'tipo_curso', 'fk_coordenador_id'], 'required'],
            [['fk_coordenador_id'], 'integer'],
            [['descricao', 'tipo_curso'], 'string', 'max' => 60],
            [['fk_coordenador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coordenador::className(), 'targetAttribute' => ['fk_coordenador_id' => 'id']],
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
            'tipo_curso' => 'Tipo Curso',
            'fk_coordenador_id' => 'Fk Coordenador ID',
        ];
    }

    /**
     * Gets query for [[FkCoordenador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCoordenador()
    {
        return $this->hasOne(Coordenador::className(), ['id' => 'fk_coordenador_id']);
    }

    /**
     * Gets query for [[DisciplinasDisponiveisCursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinasDisponiveisCursos()
    {
        return $this->hasMany(DisciplinasDisponiveisCurso::className(), ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[DisciplinasDisponiveis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinasDisponiveis()
    {
        return $this->hasMany(DisciplinasDisponivei::className(), ['id' => 'disciplinas_disponiveis_id'])->viaTable('{{%disciplinas_disponiveis_curso}}', ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[Turmas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['fk_curso_id' => 'id']);
    }

    /**
     * Gets query for [[UnidadeCursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadeCursos()
    {
        return $this->hasMany(UnidadeCurso::className(), ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[Unidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnidades()
    {
        return $this->hasMany(Unidade::className(), ['id' => 'unidade_id'])->viaTable('{{%unidade_curso}}', ['curso_id' => 'id']);
    }
}
