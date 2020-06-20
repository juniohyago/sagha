<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Datas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dataHora_inicio')->textInput() ?>

    <?= $form->field($model, 'dataHora_fim')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
