<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%aula}}".
 *
 * @property int $id
 * @property string $descricao
 * @property int $fk_disciplinas_disponiveis_id
 * @property int $fk_professor_id
 *
 * @property DisciplinasDisponiveis $fkDisciplinasDisponiveis
 * @property Professor $fkProfessor
 * @property AulaCurso[] $aulaCursos
 * @property Curso[] $cursos
 * @property DatasAula[] $datasAulas
 * @property Datas[] $datas
 */
class Aula extends \yii\db\ActiveRecord
{
    public $arrayCursos =[];
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
            [['descricao', 'fk_disciplinas_disponiveis_id','arrayCursos'], 'required'],
            [['fk_disciplinas_disponiveis_id', 'fk_professor_id'], 'integer'],
            [['descricao'], 'string', 'max' => 60],
            [['fk_disciplinas_disponiveis_id'], 'exist', 'skipOnError' => true, 'targetClass' => DisciplinasDisponiveis::className(), 'targetAttribute' => ['fk_disciplinas_disponiveis_id' => 'id']],
            [['fk_professor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['fk_professor_id' => 'id']],
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
            'fk_disciplinas_disponiveis_id' => 'Disciplina',
            'fk_professor_id' => 'Professor',
            'arrayCursos'=>'Cursos'
        ];
    }
    public function getallCursos(){
        return Curso::find()->where('')->all();
    }
//    public function getAllProfessores(){
//        $professores =Professor::find()->where('')->all();
//        $retorno =[];
//        foreach ($professores as $professor){
//            $retorno[$professor->id] = $professor->nome;
//        }
//        return $retorno;
//    }
    public function getAllDisciplinas(){
        $professores =DisciplinasDisponiveis::find()->where('')->all();
        $retorno =[];
        $id=Yii::$app->user->id;
        foreach ($professores as $professor){
            $retorno[$professor->id] = $professor->descricao;
        }
        return $retorno;
    }

    /**
     * Gets query for [[FkDisciplinasDisponiveis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkDisciplinasDisponiveis()
    {
        return $this->hasOne(DisciplinasDisponiveis::className(), ['id' => 'fk_disciplinas_disponiveis_id']);
    }

    /**
     * Gets query for [[FkProfessor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkProfessor()
    {
        return $this->hasOne(Professor::className(), ['id' => 'fk_professor_id']);
    }

    /**
     * Gets query for [[AulaCursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulaCursos()
    {
        return $this->hasMany(AulaCurso::className(), ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::className(), ['id' => 'curso_id'])->viaTable('{{%aula_curso}}', ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[DatasAulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatasAulas()
    {
        return $this->hasMany(DatasAula::className(), ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[Datas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatas()
    {
        return $this->hasMany(Datas::className(), ['id' => 'datas_id'])->viaTable('{{%datas_aula}}', ['aula_id' => 'id']);
    }
}
