<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%datas_professor}}".
 *
 * @property int $id
 * @property string $dataHora_inicio
 * @property string $dataHora_fim
 *
 * @property DatasProfessorProfessor[] $datasProfessorProfessors
 * @property Professor[] $professors
 */
class DatasProfessor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%datas_professor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataHora_inicio', 'dataHora_fim'], 'required'],
            [['dataHora_inicio', 'dataHora_fim'], 'safe'],
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
        ];
    }

    /**
     * Gets query for [[DatasProfessorProfessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatasProfessorProfessors()
    {
        return $this->hasMany(DatasProfessorProfessor::className(), ['datas_professor_id' => 'id']);
    }

    /**
     * Gets query for [[Professors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfessors()
    {
        return $this->hasMany(Professor::className(), ['id' => 'professor_id'])->viaTable('{{%datas_professor_professor}}', ['datas_professor_id' => 'id']);
    }
}
