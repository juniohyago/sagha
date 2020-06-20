<?php


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DisciplinasDisponiveis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disciplinas-disponiveis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carga_horaria')->textInput() ?>


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
            ['multiple' => 'true','options' =>$pp]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
