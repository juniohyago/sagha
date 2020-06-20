<?php

namespace app\controllers;

use app\models\Curso;
use Yii;
use app\models\DisciplinasDisponiveis;
use app\models\DisciplinasSerach;
use yii\helpers\BaseArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DisciplinasController implements the CRUD actions for DisciplinasDisponiveis model.
 */
class DisciplinasController extends Controller
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
        $searchModel = new DisciplinasSerach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            var_dump($model->arrayCursos);

            foreach ($model->arrayCursos as $cursos){

               $cursosBanco = Curso::findOne(['id'=>$cursos]);


                $model->link('cursos',$cursosBanco);
            }
           return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
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

            $model->unlinkAll('cursos',true);
            foreach ($model->arrayCursos as $cursos){

                $cursosBanco = Curso::findOne(['id'=>$cursos]);


                $model->link('cursos',$cursosBanco);
            }

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
        $this->findModel($id)->delete();

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
