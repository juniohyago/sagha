<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coordenador".
 *
 * @property int $id
 * @property string $nome
 * @property string $sobre_nome
 */
class Coordenador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coordenador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'sobre_nome'], 'required'],
            [['nome', 'sobre_nome'], 'string', 'max' => 60],
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
        ];
    }
}
