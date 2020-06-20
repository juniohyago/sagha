<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoordenadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coordenadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordenador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Coordenador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'sobre_nome',
            [
                'header'=>"Usuário",
                'attribute'=>'fkUsuario.username'
            ],
            ['class' => \app\models\actionAdmin::class],
        ],
    ]); ?>


</div>
