<?php

use yii\helpers\Html;
use yii\helpers\Arrayhelper;
use yii\widgets\ActiveForm;

use app\models\Company;

/* @var $this yii\web\View */
/* @var $model app\models\Branch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branch-form box box-primary">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'box-body']]); ?>

    
    <?= $form->field($model, 'company_fk_id')->dropDownList(
    		Arrayhelper::map(Company::find()->all(), 'company_id','company_name'),
    		['prompt'=>'Select Company']
    	) ?>

    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_created')->textInput() ?>

    <?= $form->field($model, 'branch_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive', ], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
