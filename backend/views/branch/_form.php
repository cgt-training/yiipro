<?php

use yii\helpers\Html;
use yii\helpers\Arrayhelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\Company;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Branch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branch-form box box-primary">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'box-body']]); ?>

    <div class="col-sm-6">
         <?= $form->field($model, 'company_fk_id')->dropDownList(
    		Arrayhelper::map(Company::find()->all(), 'company_id','company_name'),
    		['prompt'=>'Select Company']) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>
    </div>
  
    <div class="col-sm-6">
        <?= $form->field($model,'branch_created')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd', 'options' => [
                'class' => 'form-control','readonly' => 'readonly']]) ?>
    </div>
 
    <div class="col-sm-6">
        <?= $form->field($model, 'branch_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive', ], ['prompt' => 'Select Status']) ?>
    </div>

    <div class="form-group col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a href="<?= Url::toRoute('/branch')?>" class="btn btn-danger">Cancel</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
