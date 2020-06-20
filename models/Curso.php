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
 * @property AulaCurso[] $aulaCursos
 * @property Aula[] $aulas
 * @property Coordenador $fkCoordenador
 * @property DisciplinasDisponiveisCurso[] $disciplinasDisponiveisCursos
 * @property DisciplinasDisponiveis[] $disciplinasDisponiveis
 * @property UnidadeCurso[] $unidadeCursos
 * @property Unidade[] $unidades
 */
class Curso extends \yii\db\ActiveRecord
{
    public $unidadeSet = [];
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
            [['descricao', 'tipo_curso', 'fk_coordenador_id','unidadeSet'], 'required'],
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
            'fk_coordenador_id' => 'Coordenador',
            'unidadeSet'=>'Unidades',
        ];
    }

    /**
     * Gets query for [[AulaCursos]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getAulaCursos()
    {
        return $this->hasMany(AulaCurso::className(), ['curso_id' => 'id']);
    }

    public function getallCordenadores(){
        $cordenadores = Coordenador::find()->where('')->all();
        $arrayCordenadores = [];
        foreach ($cordenadores as $cordenador){
            $arrayCordenadores[$cordenador->id] = $cordenador->nome;
        }
        return $arrayCordenadores;

    }
    public function getallUnidades(){
        $unidades = Unidade::find()->where('')->all();
        $arrayUnidade = [];
        foreach ($unidades as $unidade){
            $arrayUnidade[$unidade->id] = $unidade->descricao;
        }
        return $unidades;

    }

    /**
     * Gets query for [[Aulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::className(), ['id' => 'aula_id'])->viaTable('{{%aula_curso}}', ['curso_id' => 'id']);
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
        return $this->hasMany(DisciplinasDisponiveis::className(), ['id' => 'disciplinas_disponiveis_id'])->viaTable('{{%disciplinas_disponiveis_curso}}', ['curso_id' => 'id']);
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
