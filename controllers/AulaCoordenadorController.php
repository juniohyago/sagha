<?php

namespace app\controllers;

use app\models\Coordenador;
use app\models\Curso;
use app\models\Datas;
use app\models\Professor;
use DateInterval;
use DateTime;
use Yii;
use app\models\Aula;
use app\models\AulaSerach;
use yii\data\ArrayDataProvider;
use yii\helpers\BaseArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AulaController implements the CRUD actions for Aula model.
 */
class AulaCoordenadorController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all Aula models.
     * @return mixed
     */
    public function actionIndex()
    {

        $id =Yii::$app->user->id;

        $usuario = Coordenador::find()->where(['fk_usuario_id'=>$id])->one();


        $todasAulas = [];
        foreach ($usuario->cursos as $curso ){

            foreach ($curso->aulas as $aula){
                $todasAulas[$aula->id] = $aula;
            }
        }
        var_dump($id);



        $dataProvider = new ArrayDataProvider([
            'allModels' => $todasAulas,
        ]);
//       // var_dump($dataProvider);
        return $this->render('index', [
           // 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aula model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Aula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new Aula();
        $data = new Datas();

        if ((
            $model->load(Yii::$app->request->post())
            &&
            $data->load(Yii::$app->request->post())
        )
        )
        {
            $dataInicio = DateTime::createFromFormat('d-M-Y H:i',$data->dataHora_inicio);
            $dataFim = DateTime::createFromFormat('d-M-Y H:i',$data->dataHora_fim);




            $model->save();
            foreach ($model->arrayCursos as $cursos){

                $cursosBanco = Curso::findOne(['id'=>$cursos]);

                $model->link('cursos',$cursosBanco);
            }
            for ($i=0;$i<$data->quantidadeSemanas;$i++){
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
                $model->link('datas',$databanco);
            }

           return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            "data"=> $data
        ]);
    }

    /**
     * Updates an existing Aula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionUpdate($id)
    {
        $data = new Datas();
       $model = $this->findModel($id);
        $datas = $model->getDatas()->all();
        $cursosSelect = $model->getCursos()->all();

        $model->arrayCursos =  BaseArrayHelper::map($cursosSelect,'id','descricao');

        if(!empty($datas)){
            $data->quantidadeSemanas = count($datas);
            $data->dataHora_inicio = $datas[0]->dataHora_inicio;
            $data->dataHora_fim = $datas[0]->dataHora_fim;

        }

        $professores = Professor::find()->where('')->all();

       // $professores[0]->datas;

        $professoresAptusData = [];
        $professoresAptusDisciplina = [];
        foreach ($professores as $professor){

            foreach ($professor->datas as $profData){
                $horaInicio = $profData->dataHora_inicio;
                $horaFim =$profData->dataHora_fim;

                foreach ($datas as $dataAula){
                        if(
                        $this->check_in_range($horaInicio,$horaFim,$dataAula->dataHora_inicio)
                            &&
                        $this->check_in_range($horaInicio,$horaFim,$dataAula->dataHora_fim)
                        ) $professoresAptusData[$professor->id] = $professor;
                }
            }
            foreach ($professor->disciplinasDisponiveis as $disciplinasaptas ){

                    if($disciplinasaptas->id === $model->fk_disciplinas_disponiveis_id ){

                        $professoresAptusDisciplina[$professor->id] = $professor;
                    }
            }
        }

        $professoresaptosTotal =array_intersect_key($professoresAptusDisciplina,$professoresAptusData);
        $professoresaptosFormatados = [];
        foreach ($professoresaptosTotal as $professoraptos){
            $professoresaptosFormatados[$professoraptos->id] = "Professor: $professoraptos->nome  | Valor Hora Aula: $$professoraptos->valor_hora_aula  | Titulação: $professoraptos->titulacao";
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'data'=> $data,
            'professoresAptos'=>$professoresaptosFormatados,
        ]);
    }

    /**
     * Deletes an existing Aula model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aula::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function check_in_range($start_date, $end_date, $date_from_user)
    {
        // Convert to timestamp
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($date_from_user);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }
}
