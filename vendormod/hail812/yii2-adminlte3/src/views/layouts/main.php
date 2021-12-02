<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>





<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<style>
    body{
        font-size: 0.9rem;

    }
.nav-treeview{

    background: #2c3b41;
}
.main-sidebar .sidebar {
    background-color: #222d32;
}

.user-panel>.image>img {
    width: 100%;
    max-width: 45px;
    height: auto;
}
.user-panel>.info>p {
    font-weight: 600;
    margin-bottom: 9px;
    margin: 0 0 10px;
}
.user-panel>.info>a {
    text-decoration: none;
    padding-right: 5px;
    margin-top: 3px;
    font-size: 11px;
}
.user-panel>.info>a 
{
    color:white;
}

.user-panel>.info>p
{
    color:white;
}
.user-panel>.info>a>.fa, .user-panel>.info>a>.ion, .user-panel>.info>a>.glyphicon {
    margin-right: 3px;
}
.main-sidebar .sidebar-menu .nav-item a{
    padding: 12px 5px 12px 15px;
    display: block;
    border-left: 3px solid transparent;
}
.main-sidebar .sidebar-menu .nav-item a:hover{
    border-left-color: #007bff;
}
.main-sidebar .sidebar-menu
    {
        padding-left : 0px;
    }
    .nav-sidebar > li > a
    {
        padding: 12px 5px 12px 15px;
        display: block;
        border-left: 3px solid transparent;
    }
    .nav-sidebar > li > a:hover
    {
        border-left-color: #007bff;
    }
    .content-header h1 {
        font-size: 1.1rem !important;
        margin: 0;
    }
    .content-header {
        padding: 10px .5rem;
        padding-bottom: 0px;
    }
        </style>