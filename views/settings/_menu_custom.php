<?php

use yii\helpers\Url;

function setActive($page){
    if(Yii::$app->controller->action->id == $page){
        return 'active';
    }
}

?>
<div class="card col-8 p-0">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link <?= setActive('profile');?>" href="<?= Url::to('/user/settings/profile');?>">Профиль</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= setActive('account');?>" href="<?= Url::to('/user/settings/account');?>">Аккаунт</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= setActive('security');?>" href="<?= Url::to('/user/settings/security');?>">Безопасность</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
   <!--  <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div> -->