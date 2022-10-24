<?php 
use yii\helpers\Url;
use backend\components\Menu_admin;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a class="logo" href="/backend/web/"><span class="logo-lg">SAE</span></a>
    <section class="sidebar">
    
        <!-- Sidebar user panel -->
        <div class="user-panel  mt-3 pb-3 mb-3 d-flex">
            <div class="text-center image">
                <img src="/backend/web/images/user2-160x160.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="text-center info">
                <p><?= Yii::$app->user->identity->nombres.' '.Yii::$app->user->identity->apellidos ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
             
            </div>
        </div>

        <?php
          $menuadmin= New Menu_admin;
          $menuadmin= $menuadmin->getMenuadmin(0,$this->context->route);
        ?>
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="padding-left:0px;">
        <?= \hail812\adminlte\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuadmin,
                /*'items' => [
                    ['label' => '', 'options' => ['class' => 'header']],
                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    $menu,
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],*/
            ]
        ) ?>
        </ul>
</nav>
        <!-- /.sidebar-menu -->
    </section>

</aside>
<style>
 .logo {
    background-color: #007bff;
    color: #fff;
    border-bottom: 0 solid transparent;
    -webkit-transition: width .3s ease-in-out;
    -o-transition: width .3s ease-in-out;
    transition: width .3s ease-in-out;
    display: block;
    height: 100%;
    font-size: 13px;
    line-height: 50px;
    text-align: center;
    width: 100%;
    font-weight: 500;
    overflow: hidden;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";


}
    </style>
