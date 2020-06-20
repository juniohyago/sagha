<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aula */
/* @var $data app\models\Datas */

/* @var $professoresAptos app\models\Professor[] */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true,'disabled' => true]) ?>

    <?= $form->field($model, 'fk_disciplinas_disponiveis_id')->dropDownList($model->getAllDisciplinas(),['disabled' => true]) ?>
    <?= $form->field($model, 'fk_professor_id')->dropDownList($professoresAptos) ?>

    <?php
    if(!empty($model->arrayCursos)) {
        foreach ($model->arrayCursos as $key => $valor) {
            $pp[$key] = array('selected' => 'selected');

        }
    }else{
        $pp = [];
    }
    echo $form->field($model, 'arrayCursos')->listBox(

        ArrayHelper::map($model->getallCursos(),'id','descricao'),
        ['multiple' => 'true','options' =>$pp,'disabled' => true]
    ) ?>


    <?= $form->field($data, 'dataHora_inicio')->widget(DateTimePicker::class,[
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_INPUT,
        'language'=>'pt-br',
        'disabled' => true,
        'pluginOptions' => [
            'calendarWeeks' => true,
            'autoclose'=>true,
            'format' => 'dd-M-yyyy hh:ii'
        ]
    ]) ?>

    <?= $form->field($data, 'dataHora_fim')->widget(DateTimePicker::class,[
        'name' => 'dp_2',
        'type' => DateTimePicker::TYPE_INPUT,
        'language'=>'pt-br',
        'disabled' => true,
        'pluginOptions' => [
            'calendarWeeks' => true,
            'autoclose'=>true,
            'format' => 'dd-M-yyyy hh:ii'
        ]
    ]) ?>

    <?= $form->field($data, 'quantidadeSemanas')->textInput(['type' => 'number','disabled' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
