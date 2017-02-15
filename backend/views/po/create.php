<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Po */

$this->title = 'Create Po';
$this->params['breadcrumbs'][] = ['label' => 'Pos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="po-create box">
	<div class="box-body">
	   
	    <?= $this->render('_form', [
	        'model' => $model,
	        'modelsPoitem' => $modelsPoitem,
	    ]) ?>
	</div>
</div>
