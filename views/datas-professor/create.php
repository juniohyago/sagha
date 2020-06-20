<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Datas */

$this->title = 'Criar Datas';
$this->params['breadcrumbs'][] = ['label' => 'Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
