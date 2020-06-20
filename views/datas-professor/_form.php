<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Datas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dataHora_inicio')->widget(DateTimePicker::class,[
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_INPUT,
        'language'=>'pt-br',
        'pluginOptions' => [
            'calendarWeeks' => true,
            'autoclose'=>true,
            'format' => 'dd-M-yyyy hh:ii'
        ]
    ]) ?>

    <?= $form->field($model, 'dataHora_fim')->widget(DateTimePicker::class,[
        'name' => 'dp_2',
        'type' => DateTimePicker::TYPE_INPUT,
        'language'=>'pt-br',
        'pluginOptions' => [
            'calendarWeeks' => true,
            'autoclose'=>true,
            'format' => 'dd-M-yyyy hh:ii'
        ]
    ]) ?>

    <?= $form->field($model, 'quantidadeSemanas')->textInput(['type' => 'number']) ?>


    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
