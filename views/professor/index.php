<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfessorSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Professors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Professor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cpf',
            'nome',
            'sobreNome',
            'email:email',
            //'telefone',
            //'titulacao',
            //'valor_hora_aula',
            //'fkProfessor_usuario_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
