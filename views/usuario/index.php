<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Usuário', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                    'attribute'=>'tipo_usuario',
                    'filter' => false,
                    'value' => function ($model) {
                        if($model->tipo_usuario == 1){
                            return "Professor";
                        }else if($model->tipo_usuario == 2){
                            return "Coordenador";
                        }
                        else if($model->tipo_usuario == 3){
                            return "Administrador";
                        }
                 },

            ],
            'username',



            ['class' => \app\models\actionAdmin::class],
        ],
    ]); ?>


</div>
