<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form  box box-warning">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'box-body']]); ?>

    <div class="col-sm-4">
        <?= $form->field($model, 'role')->dropDownList([ 'Admin' => 'Admin', 'Sub admin' => 'Sub Admin', 'User' => 'User' ], ['prompt' => 'Select Role']) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'status')->textInput() ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'created_at')->textInput() ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'updated_at')->textInput() ?>
    </div>

    <div class="form-group col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a href="<?= Url::toRoute('/user')?>" class="btn btn-danger">Cancel</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
