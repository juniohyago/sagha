<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="curso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_curso')->dropDownList([
            'Bacharel'=>'Bacharel',
            'Licenciatura'=>'Licenciatura',
            'Tecnólogo'=>'Tecnólogo',
            'MBA'=>'MBA',
            'Mestrado'=>'Mestrado',
            'Doutorado'=>'Doutorado',
            'PHD'=>'PHD'

    ],['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_coordenador_id')->dropDownList(
            $model->getallCordenadores()) ?>

    <?= $form->field($model, 'unidadeSet')->dropDownList(
            ArrayHelper::map($model->getallUnidades(),'id','descricao')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
