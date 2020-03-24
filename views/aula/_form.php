<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_disciplinas_disponiveis_id')->textInput() ?>

    <?= $form->field($model, 'fk_turmas_id')->textInput() ?>

    <?= $form->field($model, 'dataHora_inicio')->textInput() ?>

    <?= $form->field($model, 'dataHora_fim')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
