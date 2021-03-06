<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DatasSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Datas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dataHora_inicio',
            'dataHora_fim',

            ['class' => \app\models\actionAdmin::class],
        ],
    ]); ?>


</div>
