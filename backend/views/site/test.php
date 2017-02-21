<?php
use Yii\app;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$this->title = 'Access Control Error';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="box1 box-default">
            
            <!-- /.box-header -->
            <div class="box-body1">
              <div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Notice!</h4>
                You don't have to do this action . Please contact to administrator.
              </div>
              <a class="btn btn-info" href="<?php echo Yii::$app->request->referrer; ?>">Return to previous page</a>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

       
      </div>
      

    </section>
<?php
Yii::app()->params['TEXT_ACTIVE'] = 'Active'; //1 for active
 
Yii::app()->params['AD_LAYOUT_POISITION'] = array(
    "1" => array(
        'width' => '1000',
        'height' => '150'
    ),
    "2" => array(
        'width' => '200',
        'height' => '150'
    ),
    "3" => array(
        'width' => '1000',
        'height' => '150'
    ),
    "4" => array(
        'width' => '200',
        'height' => '150'
    ),
);
?>