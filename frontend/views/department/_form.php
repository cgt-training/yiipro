<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;

use app\models\Company;
use app\models\Branch;

/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_fk_id')->dropDownList(
            Arrayhelper::map(Company::find()->all(), 'company_id','company_name'),
            [
                'prompt'=>'Select Company',
                // 'onchange'=>'$.post("index.php?r=branch/lists&id='.'"+$(this).val(), function( data ) {
                //     $( "select#models-country" ).html(data);
                // });'
                'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('branch/lists?id=').'"+$(this).val(), function( data ) {
                  $( "select#department-branch_fk_id" ).html( data );
                });'
            ]
        ) ?>

    
    <?= $form->field($model, 'branch_fk_id')->dropDownList(
            Arrayhelper::map(Branch::find()->all(), 'branch_id','branch_name'),
            [
                'prompt'=>'Select Branch',
            ]
        ) ?>

    <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_created')->textInput() ?>

    <?= $form->field($model, 'department_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
