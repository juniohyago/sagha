<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aula */
/* @var $data app\models\Datas */


$this->title = 'Criar Aula';
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
