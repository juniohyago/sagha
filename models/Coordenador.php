<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%coordenador}}".
 *
 * @property int $id
 * @property string $nome
 * @property string $sobre_nome
 * @property int $fk_usuario_id
 *
 * @property Usuario $fkUsuario
 * @property Curso[] $cursos
 */
class Coordenador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%coordenador}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'sobre_nome', 'fk_usuario_id'], 'required'],
            [['fk_usuario_id'], 'integer'],
            [['nome', 'sobre_nome'], 'string', 'max' => 60],
            [['fk_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fk_usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'sobre_nome' => 'Sobre Nome',
            'fk_usuario_id' => 'Fk Usuario ID',
        ];
    }

    /**
     * Gets query for [[FkUsuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'fk_usuario_id']);
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::className(), ['fk_coordenador_id' => 'id']);
    }
}
