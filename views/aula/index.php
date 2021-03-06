<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AulaSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aulas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Aula', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descricao',
            [
                'header' => 'Disciplina',
                'attribute' => 'fkDisciplinasDisponiveis.descricao',
                'filter' =>$searchModel
            ],

            [
                    'header' => 'Professor',
                    'attribute' =>  'fkProfessor.nome'
            ],
            ['class' => \app\models\actionAdmin::class],
        ],
    ]); ?>


</div>
