<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Professor;

/**
 * ProfessorSerach represents the model behind the search form of `app\models\Professor`.
 */
class ProfessorSerach extends Professor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fkProfessor_usuario_id'], 'integer'],
            [['cpf', 'nome', 'sobreNome', 'email', 'telefone', 'titulacao'], 'safe'],
            [['valor_hora_aula'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Professor::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'valor_hora_aula' => $this->valor_hora_aula,
            'fkProfessor_usuario_id' => $this->fkProfessor_usuario_id,
        ]);

        $query->andFilterWhere(['like', 'cpf', $this->cpf])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'sobreNome', $this->sobreNome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'titulacao', $this->titulacao]);

        return $dataProvider;
    }
}
