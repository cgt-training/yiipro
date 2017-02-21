<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;
use yii\web\JqueryAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form box box-success">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class' => 'box-body']]); ?>

    <div class="col-sm-4">
        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'company_email')->textInput(['type' => 'email','maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'company_profile')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-6">
        <div class="col-sm-6"><?= $form->field($model, 'logo')->fileInput(['id' => 'imag','class' => 'form-control']) ?></div>
         <div class="col-sm-6"><?= Html::img( '@web/'.$model->logo,[ 'id' => 'viewimg' , 'style' => 'width: 50px;' ]);?></div>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model,'company_created')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd', 'options' => [
                'class' => 'form-control','readonly' => 'readonly'
             ]]) ?>
    </div>
    
    <div class="col-sm-6">
        <?= $form->field($model, 'company_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive', ], ['prompt' => 'Select Status']) ?>
    </div>

    <div class="form-group col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a href="<?= Url::toRoute('/company')?>" class="btn btn-danger">Cancel</a>
    </div>
   
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
//jQuery.noConflict();
    $(document).ready(function () {
       $('#imag').change(function(){
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#viewimg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>