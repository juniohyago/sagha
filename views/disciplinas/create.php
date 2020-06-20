<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DisciplinasDisponiveis */

$this->title = 'Create Disciplinas Disponiveis';
$this->params['breadcrumbs'][] = ['label' => 'Disciplinas Disponiveis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disciplinas-disponiveis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
