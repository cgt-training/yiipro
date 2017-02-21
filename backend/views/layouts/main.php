<?php
/* @var $this \yii\web\View */
/* @var $content string */
use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <header class="main-header">
    <!-- Logo -->
    <a href="admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin </b>YII</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <img src="dist/img/kanh.jpg" class="user-image" alt="User Image"> -->
              <?= Html::img('@web/dist/img/kanh.jpg',['class'=>'user-image img-circle']);?>
              <span class="hidden-xs"><?php //echo Yii::$app->user->identity->username ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <!-- <img src="dist/img/kanh.jpg" class="img-circle" alt="User Image"> -->
                <?= Html::img('@web/dist/img/kanh.jpg',['class'=>'img-circle']);?>
                <p>
                  <?php if(isset(Yii::$app->user->identity->username)){echo Yii::$app->user->identity->username;}?>
                 <?php if(isset(Yii::$app->user->identity->created_at)){?> <small>Member since <?php echo Yii::$app->formatter->asDate(Yii::$app->user->identity->created_at, 'dd-MM-YYYY');?></small><?php }?>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <?php 
                      $menuItems[] = '<div>'
                          . Html::beginForm(['/site/logout'], 'post')
                          . Html::submitButton(
                              'Logout',
                              ['class' => 'btn btn-danger btn-flat']
                          )
                          . Html::endForm()
                          . '</div>';
                  echo Nav::widget([
                      'options' => ['class' => 'pull-right'],
                      'items' => $menuItems,
                      
                  ]);
                          ?>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>

  <?php //echo Yii::$app->controller->id;die;?>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?= Html::img('@web/dist/img/kanh.jpg',['class'=>'user-image img-circle']);?>

          <!-- <img src="dist/img/kanh.jpg" class="img-circle" alt="User Image"> -->
        </div>
        <div class="pull-left info">
          <p><?php if(isset(Yii::$app->user->identity->username)){ echo Yii::$app->user->identity->username;}?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?= Yii::$app->controller->id=='site'?'active':''?>  treeview">
          <a href="<?= Url::toRoute('/')?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="<?= Yii::$app->controller->id=='branch'?'active':''?>  treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Branch</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= Url::toRoute('/branch/create')?>"><i class="fa fa-location-arrow"></i> Create Branch</a></li>
            <li><a href="<?= Url::toRoute('/branch')?>"><i class="fa fa-location-arrow"></i> View Branch</a></li>
           </ul>
        </li>
        <li class="<?= Yii::$app->controller->id=='company'?'active':''?> treeview">
          <a href="#">
            <i class="fa fa-th"></i> 
            <span>Company</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
            <li><a href="<?= Url::toRoute('/company/create')?>"><i class="fa fa-location-arrow"></i> Create Company</a></li>
            <li><a href="<?= Url::toRoute('/company')?>"><i class="fa fa-location-arrow"></i> View Company</a></li>
           </ul>
        </li>
        <li class="<?= Yii::$app->controller->id=='department'?'active':''?> treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Department</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= Url::toRoute('/department/create')?>"><i class="fa fa-location-arrow"></i> Create Department</a></li>
            <li><a href="<?= Url::toRoute('/department')?>"><i class="fa fa-location-arrow"></i> View Department</a></li>
           </ul>
        </li>
        <li class="<?= Yii::$app->controller->id=='user'?'active':''?> treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= Url::toRoute('/user/create')?>"><i class="fa fa-location-arrow"></i> Create User</a></li>
            <li><a href="<?= Url::toRoute('/user')?>"><i class="fa fa-location-arrow"></i> View User</a></li>
           </ul>
        </li>
         <li class="<?= Yii::$app->controller->id=='po'?'active':''?> treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Po Item</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= Url::toRoute('/po/create')?>"><i class="fa fa-location-arrow"></i> Create Po Item</a></li>
            <li><a href="<?= Url::toRoute('/po')?>"><i class="fa fa-location-arrow"></i> View Po Item</a></li>
           </ul>
        </li>
     
    </section>
    <!-- /.sidebar -->
  </aside>

    
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1><?php echo end($this->params['breadcrumbs']);?></h1>
          
     <?= Breadcrumbs::widget([
          'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]) ?>
     
</section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <?= $content ?>
                    </div>
                </div>
            </section>
    </div>


</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>