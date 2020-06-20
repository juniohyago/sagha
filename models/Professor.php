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
 * @property string $email
 * @property string $telefone
 * @property string $titulacao
 * @property float $valor_hora_aula
 * @property int $fkProfessor_usuario_id
 *
 * @property Aula[] $aulas
 * @property DatasProfessor[] $datasProfessors
 * @property Datas[] $datas
 * @property DisciplinasDisponiveisProfessor[] $disciplinasDisponiveisProfessors
 * @property DisciplinasDisponiveis[] $disciplinasDisponiveis
 * @property Usuario $fkProfessorUsuario
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
            [['cpf', 'nome', 'sobreNome', 'email', 'telefone', 'titulacao', 'valor_hora_aula', 'fkProfessor_usuario_id'], 'required'],
            [['valor_hora_aula'], 'number'],
            [['fkProfessor_usuario_id'], 'integer'],
            [['cpf'], 'string', 'max' => 12],
            [['nome', 'sobreNome', 'titulacao'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['telefone'], 'string', 'max' => 20],
            [['fkProfessor_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkProfessor_usuario_id' => 'id']],
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
            'sobreNome' => 'Sobrenome',
            'email' => 'Email',
            'telefone' => 'Telefone',
            'titulacao' => 'Titulacao',
            'valor_hora_aula' => 'Valor Hora Aula',
            'fkProfessor_usuario_id' => 'Usuario',
        ];
    }

    /**
     * Gets query for [[Aulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::className(), ['fk_professor_id' => 'id']);
    }

    public function getUsuariosDisponiveis(){
      $usuarios =  Usuario::find()->where('')->all();
      $professoresDisponveis = [];
      foreach ($usuarios as $usuario){
         if($usuario->tipo_usuario == 1 && empty($usuario->professors)){
             $professoresDisponveis[$usuario->id] = $usuario->username;
         }
      }
      return $professoresDisponveis;

    }
    /**
     * Gets query for [[DatasProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatasProfessors()
    {
        return $this->hasMany(DatasProfessor::className(), ['professor_id' => 'id']);
    }

    /**
     * Gets query for [[Datas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatas()
    {
        return $this->hasMany(Datas::className(), ['id' => 'datas_id'])->viaTable('{{%datas_professor}}', ['professor_id' => 'id']);
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
        return $this->hasMany(DisciplinasDisponiveis::className(), ['id' => 'disciplinas_disponiveis_id'])->viaTable('{{%disciplinas_disponiveis_professor}}', ['professor_id' => 'id']);
    }

    /**
     * Gets query for [[FkProfessorUsuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkProfessorUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'fkProfessor_usuario_id']);
    }
}
