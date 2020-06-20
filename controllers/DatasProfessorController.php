<?php


namespace app\controllers;


use app\models\Datas;
use app\models\DatasSerach;
use app\models\Professor;
use DateTime;
use Yii;
use yii\data\ArrayDataProvider;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DatasProfessorController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $id =Yii::$app->user->id;
        $usuarioProfessor = Professor::find()->where(['fkProfessor_usuario_id'=>$id])->one();

        $dataProviderArray = [];
        foreach ($usuarioProfessor->datas as $data){
            $dataProviderArray[$data->id]  = $data;
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataProviderArray,
        ]);

        return $this->render('index', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        try {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } catch (NotFoundHttpException $e) {
        }
    }
    public function actionCreate()
    {
        $model = new Datas();
        $id =Yii::$app->user->id;
        $usuarioProfessor = Professor::find()->where(['fkProfessor_usuario_id'=>$id])->one();

        if ($model->load(Yii::$app->request->post())) {
            $dataInicio = DateTime::createFromFormat('d-M-Y H:i',$model->dataHora_inicio);
            if(!$dataInicio){
                $dataInicio = DateTime::createFromFormat('d-m-Y H:i',$model->dataHora_inicio);
            }
            $dataFim = DateTime::createFromFormat('d-M-Y H:i',$model->dataHora_fim);
            if(!$dataFim){
                $dataFim = DateTime::createFromFormat('d-m-Y H:i',$model->dataHora_fim);
            }

            ;


            $datasSemanasInicio = [];

            for ($i=0;$i<$model->quantidadeSemanas;$i++){
                $dtInicio = new DateTime('@' . $dataInicio->getTimestamp());
                $dtInicio->modify("+$i week");
                $dataInicioFormatada = $dtInicio->format('Y-m-d H:i');

                $dtFim = new DateTime('@' . $dataFim->getTimestamp());
                $dtFim->modify("+$i week");
                $dataFinalFormatada = $dtFim->format('Y-m-d H:i');

                $databanco = new Datas();
                $databanco->dataHora_inicio = $dataInicioFormatada;
                $databanco->dataHora_fim = $dataFinalFormatada;
                $databanco->save();
                $databanco->link('professors',$usuarioProfessor);
            }

            return $this->redirect(['index']);
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        try {
            $model = $this->findModel($id);
        } catch (NotFoundHttpException $e) {
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
       return  Datas::findOne($id);

    }

}