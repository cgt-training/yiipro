<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;
use yii\jui\DatePicker;
use app\models\Company;
use app\models\Branch;
use yiipro\widgets\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form box box-danger">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'box-body']]); ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'company_fk_id')->dropDownList(
                Arrayhelper::map(Company::find()->all(), 'company_id','company_name'),
                [
                    'prompt'=>'Select Company',
                    'onchange'=>'
                    $.post( "'.Yii::$app->urlManager->createUrl('branch/lists?id=').'"+$(this).val(), function( data ) {
                      $("select#department-branch_fk_id" ).html( data );remattr();
                    });',
                ]
            ) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'branch_fk_id')->dropDownList(
                Arrayhelper::map(['empty'=>'Empty string'], 'branch_id','branch_name'),
                [
                    'prompt'=>'Select Branch',
                    'disabled' => true,
                ]
            ) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model,'department_created')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd', 'options' => [
                    'class' => 'form-control','readonly' => 'readonly'
                 ]]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'department_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive', ], ['prompt' => 'Select Status']) ?>
    </div>

    <div class="form-group col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
         <a href="<?= Url::toRoute('/department')?>" class="btn btn-danger">Cancel</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
 function remattr(){
       if((document.getElementById('department-company_fk_id').value)!=0)
        {
            document.getElementById('department-branch_fk_id').removeAttribute("disabled");
        }else{

        }
    }

</script>
