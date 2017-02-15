<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;

use app\models\Company;
use app\models\Branch;
use yiipro\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form box box-danger">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'box-body']]); ?>

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

    
    <?= $form->field($model, 'branch_fk_id')->dropDownList(
            Arrayhelper::map(['empty'=>'Empty string'], 'branch_id','branch_name'),
            [
                'prompt'=>'Select Branch',
                'disabled' => true,
            ]
        ) ?>


    <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_created')->textInput() ?>

    <?= $form->field($model, 'department_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive', ], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
