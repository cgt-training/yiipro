<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index box">
    <div class="box-body">
    <?php $form = ActiveForm::begin(['id' => 'search' ,'options' => ['class' => 'box-body']]);

               echo $form->field($searchModel, 'searchstring', [
                'template' => '<div class="input-group">{input}<span class="input-group-btn">' .
                Html::submitButton('Click for Search', ['class' => 'btn btn-danger']) .
                '</span></div>',
            ])->textInput(['placeholder' => 'type text for search....', 'onkeydown'=>"$('#search').submit();"]);

     ActiveForm::end(); ?>
        <div id="main-div">
            <?php Pjax::begin(); ?>    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                   // 'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'company_id',
                        'company_name',
                        'company_email:email',
                        'company_address',
                        'company_profile',
                        // 'company_created',
                        // 'company_status',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
    $(document).ready(function () {
        $('body').on('beforeSubmit', 'form#search', function () {
            var form = $(this);
            // return false if form still have some validation errors
            if (form.find('.has-error').length) 
            {
                return false;
            }
            // submit form
            $.ajax({
            url    : form.attr('action'),
            type   : 'post',
            data   : form.serialize(),
            success: function (response) 
            {
                $('#main-div').html($(response).find('#main-div'));
            },
            error  : function () 
            {
                console.log('internal server error');
            }
            });
            return false;
         });
    });
</script>