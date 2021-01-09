<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use dektrium\user\widgets\UserMenu;

/**
 * @var dektrium\user\models\User $user
 */

$user = Yii::$app->user->identity;
?>
<div class="card  menu p-3">
    <div class="card-header">
        <h3 class="card-title">
            <?/*= Html::img($user->profile->getAvatarUrl(24), [
                'class' => 'img-rounded',
                'alt' => $user->username,
            ]) */ ?> 
            <i class="fas fa-user-cog"></i> <?= $user->username ?>
        </h3>
    </div>
    <div class="card-body">
        <?= UserMenu::widget() ?>
    </div>
</div>
