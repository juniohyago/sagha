<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfessorSerach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="professor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cpf') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'sobreNome') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'telefone') ?>

    <?php // echo $form->field($model, 'titulacao') ?>

    <?php // echo $form->field($model, 'valor_hora_aula') ?>

    <?php // echo $form->field($model, 'fkProfessor_usuario_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
