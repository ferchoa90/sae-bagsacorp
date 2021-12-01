<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'SAE - Sistema Administrativo Contable';
?>
<body style="text-align:center; font-family:consolas">
  <!--   <div>
        <img style="width:100px;    vertical-align: middle;" src="<?= URL::base()?>/images/logotodosvuelven.png" />
    </div> -->
    <div class="center-titulos" style="text-align:left;font-size:16px; font-weight:none;">
        <span style="font-weight:none;"> PREMIERE FOOD</span>

        <br><span style="line-height: 38px;font-size:11px; ">-----------------------------</span><!--  <?//= Yii::$app->user->identity->sucursal->nombre; ?> -->
        <br><span style="line-height: 25px;font-size:14px;">Ticket N. <?=$gestion->id?></span>

        <div class="left-titulos"  style="font-size:9.5px;line-height:18px;">
     
      Fecha:  <?=date('d/m/Y H:i:s', strtotime(str_replace('-', '/', $gestion->idmarcacion0->fechahora)));   ?>  
        <br>Nombres:  <?=substr(strtoupper($gestion->iduser0->apellidos.' '.$gestion->iduser0->nombres),0,28) ?>
        <br>Empresa:  <?=$gestion->iduser0->iddepartamento0->nombre ?>
        <br>Servicio:  <?=$gestion->idhorarioc0->nombre ?>
    
        <br><span style="line-height: 38px;font-size:11px; font-weight:none;">-----------------------------</span>
        
    <div class="left-titulos" style="font-size:8.5px; padding: 0px;">
        Impreso por Sistema ComControl 1.0
    </div>
    <div class="left-titulos" style="font-size:9px; padding: 0px;">

        -- Reimpreso --
      
        <br><span style="line-height: 80px;font-size:7px; font-weight:none;">---</span>
    </div>
    </div>
    </div>
    </div>
   
   
   
</body>
<style>

body
    {
        font-family: Arial, sans-serif;
        font-size : 9px;
        line-height:15px;
    }

.center-titulos{
    padding:2px;
    padding-top:10px;
    text-align:center;
}
.left-titulos{
    padding:2px;
    text-align:left;
}
</style>