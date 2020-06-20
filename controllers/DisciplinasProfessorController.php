<?php


namespace app\controllers;


use app\models\Curso;
use app\models\Datas;
use app\models\DatasSerach;
use app\models\DisciplinasDisponiveis;
use app\models\DisciplinasSerach;
use app\models\Professor;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\BaseArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DisciplinasProfessorController extends Controller
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
     * Lists all DisciplinasDisponiveis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id =Yii::$app->user->id;
        $usuarioProfessor = Professor::find()->where(['fkProfessor_usuario_id'=>$id])->one();

        $disciplinasArray = [];
        foreach ($usuarioProfessor->disciplinasDisponiveis as $disciplinas){
            $disciplinasArray[$disciplinas->id]  = $disciplinas;
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $disciplinasArray,
        ]);

        $searchModel = new DisciplinasSerach();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DisciplinasDisponiveis model.
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
     * Creates a new DisciplinasDisponiveis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DisciplinasDisponiveis();
        $id =Yii::$app->user->id;
        $usuarioProfessor = Professor::find()->where(['fkProfessor_usuario_id'=>$id])->one();
        $disciplinaDisponiveis = DisciplinasDisponiveis::find()
            ->where('')
            ->all();


        foreach ($disciplinaDisponiveis as $disciplinaDisponivei){
            $arrayDisponiveis[$disciplinaDisponivei->id] = $disciplinaDisponivei;
        }
        foreach ($usuarioProfessor->disciplinasDisponiveis as$selecionadas){
            $novo[$selecionadas->id] = $selecionadas;
       }
        if(!empty($novo)){
            $disponiveis = array_diff_key($arrayDisponiveis,$novo);
        }else{
            $disponiveis = $arrayDisponiveis;
        }


        if ($model->load(Yii::$app->request->post())) {

            foreach ($model->arrayDisciplinas as $disciplina){
                $banco = DisciplinasDisponiveis::find()->where(['id'=>$disciplina])->one();
                $banco->link('professors',$usuarioProfessor);
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'disponiveis'=>$disponiveis
        ]);
    }

    /**
     * Updates an existing DisciplinasDisponiveis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cursos =$model->getCursos()->all();

        $model->arrayCursos =  BaseArrayHelper::map($cursos,'id','descricao');

        //var_dump( $model->arrayCursos);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DisciplinasDisponiveis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $disciplina =$this->findModel($id);
        $id =Yii::$app->user->id;
        $usuarioProfessor = Professor::find()->where(['fkProfessor_usuario_id'=>$id])->one();
        $disciplina->unlink('professors',$usuarioProfessor,true);
        return $this->redirect(['index']);
    }

    /**
     * Finds the DisciplinasDisponiveis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DisciplinasDisponiveis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DisciplinasDisponiveis::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}