<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php 
    //$img = Url::to('@web/frontend/web/css/'.'logo.png');     
    NavBar::begin([
        //'brandLabel' => 'My Company',
        'brandLabel' => Html::img('@web/img/logo.png', ['alt'=>Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
     /*   ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Country', 'url' => ['/country/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],*/
        ['label' => 'HOME', 'url' => ['/site/index']],
        ['label' => 'BRANCH', 'url' => ['/branch']],
        ['label' => 'COMPANY', 'url' => ['/company']],
        ['label' => 'DEPARTMENT', 'url' => ['/department']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'SIGNUP', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'LOGIN', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer>
    <div class="container">
        <div class="row" style="margin-top:15px">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center">
                <ul class="cul" style="display: inline-flex; margin-right:0px;list-style:none">
                    <li style="font-size: 25px;margin-right: 15px;"><i class="fa fa-facebook"></i></li>
                    <li style="font-size: 25px;margin-right: 15px;"><i class="fa fa-twitter"></i></li>
                    <li style="font-size: 25px;margin-right: 15px;"><i class="fa fa-google-plus"></i></li>
                    <li style="font-size: 25px;margin-right: 15px;"><i class="fa fa-youtube"></i></li>
                    <li style="font-size: 25px;margin-right: 15px;"><i class="fa fa-instagram"></i></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center;font-size: 10px;">
                <ul class="cul" style="display: inline-flex; margin-right:0px;list-style:none">
                    <li>Blog</li>
                    <li> | Terms</li>
                    <li> | Privacy</li>
                    <li> | Contact Us</li>
                    <li> | Feedback</li>
                    <li> | Brands</li>
                    <li> | Community Guidelines</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center;font-size: 10px;">
                <p>Copyright 2014 Macro Tracking. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
