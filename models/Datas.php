<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%datas}}".
 *
 * @property int $id
 * @property string $dataHora_inicio
 * @property string $dataHora_fim
 *
 * @property DatasAula[] $datasAulas
 * @property Aula[] $aulas
 * @property DatasProfessor[] $datasProfessors
 * @property Professor[] $professors
 */
class Datas extends \yii\db\ActiveRecord
{
    public $quantidadeSemanas = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%datas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataHora_inicio', 'dataHora_fim','quantidadeSemanas'], 'required'],
            [['dataHora_inicio', 'dataHora_fim','quantidadeSemanas'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dataHora_inicio' => 'Data Hora Inicio',
            'dataHora_fim' => 'Data Hora Fim',
            'quantidadeSemanas' => 'Quantas Semanas',
        ];
    }

    /**
     * Gets query for [[DatasAulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatasAulas()
    {
        return $this->hasMany(DatasAula::className(), ['datas_id' => 'id']);
    }

    /**
     * Gets query for [[Aulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::className(), ['id' => 'aula_id'])->viaTable('{{%datas_aula}}', ['datas_id' => 'id']);
    }

    /**
     * Gets query for [[DatasProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatasProfessors()
    {
        return $this->hasMany(DatasProfessor::className(), ['datas_id' => 'id']);
    }

    /**
     * Gets query for [[Professors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfessors()
    {
        return $this->hasMany(Professor::className(), ['id' => 'professor_id'])->viaTable('{{%datas_professor}}', ['datas_id' => 'id']);
    }
}
