<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$formatter = Yii::$app->formatter;
$lastAccountStats = $model->lastAccountStats;

?>

<div class="box box-primary">

    <div class="box-body box-profile">
        <?php if ($model->profile_pic_url): ?>
            <?= Html::img($model->profile_pic_url, ['class' => 'profile-user-img img-responsive img-circle']) ?>
        <?php endif; ?>
        <h3 class="profile-username text-center">
            <?= Html::encode($model->usernamePrefixed) ?>
        </h3>
        <p class="text-muted text-center">
            <?= Html::encode($model->full_name) ?>
        </p>
        <?php if ($lastAccountStats): ?>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b><?= $lastAccountStats->getAttributeLabel('followed_by') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asInteger($lastAccountStats->followed_by) ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <b><?= $lastAccountStats->getAttributeLabel('follows') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asInteger($lastAccountStats->follows) ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <b><?= $lastAccountStats->getAttributeLabel('media') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asInteger($lastAccountStats->media) ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <b><?= $lastAccountStats->getAttributeLabel('er') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asPercent($lastAccountStats->er) ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <b><?= $lastAccountStats->getAttributeLabel('created_at') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asDatetime($lastAccountStats->created_at) ?>
                    </a>
                </li>
            </ul>
        <?php endif; ?>
        <?= Html::a($model->monitoring ? '<span class="fa fa-stop"></span> Turn off monitoring' : '<span class="fa fa-play"></span> Turn on monitoring', ['monitoring', 'id' => $model->id], [
            'class' => 'btn btn-block ' . ($model->monitoring ? 'btn-danger' : 'btn-success'),
            'data' => [
                'method' => 'post',
                'confirm' => 'Are you sure?',
            ],
        ]) ?>
        <?= \app\modules\admin\widgets\FavoriteButton::widget([
            'model' => $model,
        ]) ?>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Description</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php if ($model->external_url): ?>
            <strong><i class="fa fa-external-link margin-r-5"></i>
                <?= $model->getAttributeLabel('external_url') ?>
            </strong>
            <p class="text-muted">
                <?= Html::a($model->external_url, $model->external_url, ['target' => '_blank']) ?>
            </p>
            <hr>
        <?php endif; ?>
        <?php if ($model->biography): ?>
            <strong><i class="fa fa-book margin-r-5"></i>
                <?= $model->getAttributeLabel('biography') ?>
            </strong>
            <p class="text-muted">
                <?= $formatter->asNtext($model->biography) ?>
            </p>
            <hr>
        <?php endif; ?>

        <?= \app\modules\admin\widgets\TagsWidget::widget([
            'model' => $model,
        ]); ?>
        <hr>

        <strong>
            <i class="fa fa-file-text-o margin-r-5"></i> Notes (TODO)
            <a href="#" class="btn btn-xs btn-link">add</a>
        </strong>

        <p>
            Administrator notes
        </p>
    </div>
    <!-- /.box-body -->
</div>