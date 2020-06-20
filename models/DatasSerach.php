<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Datas;
use yii\data\ArrayDataProvider;

/**
 * DatasSerach represents the model behind the search form of `app\models\Datas`.
 */
class DatasSerach extends Datas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['dataHora_inicio', 'dataHora_fim'], 'safe'],
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
        $id =Yii::$app->user->id;
        //$usuario = Usuario::find()->where(['id'=>$id])->one();

        $usuarioProfessor = Professor::find()->where(['fkProfessor_usuario_id'=>$id]);
        //var_dump($usuarioProfessor->datas);
//        if($usuario->tipo_usuario === 1){
//           $usuarioProfessor = Professor::find()->where(['fkProfessor_usuario_id'=>$usuario->tipo_usuario->id])->one();
//        }
        //$usuario->datas();
       // var_dump( $usuario->datas);
        //$query = Datas::find()->join('inner join','professor');

        // add conditions that should always apply here


        $dataProvider = new ArrayDataProvider([
            'allModels' => $usuarioProfessor->datas,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'dataHora_inicio' => $this->dataHora_inicio,
//            'dataHora_fim' => $this->dataHora_fim,
//        ]);

        return $dataProvider;
    }
}
