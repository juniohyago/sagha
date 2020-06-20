<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Professor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="professor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fkProfessor_usuario_id')->dropDownList($model->getUsuariosDisponiveis()) ?>

    <?= $form->field($model, 'cpf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sobreNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titulacao')->dropDownList([
        'Bacharel'=>'Bacharel',
        'Licenciatura'=>'Licenciatura',
        'Tecnólogo'=>'Tecnólogo',
        'Especialista'=>'Especialista',
        'MBA'=>'MBA',
        'Mestrado'=>'Mestrado',
        'Doutorado'=>'Doutorado',
        'PHD'=>'PHD'

    ],['maxlength' => true]) ?>

    <?= $form->field($model, 'valor_hora_aula')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
