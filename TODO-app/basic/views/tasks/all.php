<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Все задачи';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="jumbotron">
        <ul class="list-group">
            <?php if (count($model) <= 0) { echo "Не найдено никаких задач"; } ?>
            <?php foreach ($model as $one_task): ?>
                <?php if ($one_task->task_status == 0) {
                    $color_class = "default";
                } else {
                    $color_class = "success";
                } ?>

                <div class="panel panel-<?=$color_class?>" id="task_<?= $one_task->id ?>">
                    <div class="panel-heading">
                        <h3 class="panel-title">

                            <?php if ($one_task->task_status == 0) { ?>
                            <i class="fa fa-check-square-o move_btn" aria-hidden="true" id="move_<?= $one_task->id ?>"></i>
                            <?php } ?>

                            <div class="heading">
                                Задача № <?= $one_task->id ?>
                            </div>
                            <div class="date">
                                <?php
                                $one_task->date = strtotime($one_task->date);
                                echo $one_task->date = date("d.m.Y H:i:s",$one_task->date);
                                ?>
                            </div>
                            <i class="fa fa-times delete_btn" aria-hidden="true" id="<?= $one_task->id ?>"></i>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="text_field">
                            <?= Html::encode($one_task->text) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </ul>

        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'add-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-offset-3 col-lg-6 text-center\" >{label}:{input}<div>{error}</div></div>",
            'labelOptions' => ['class' => ' control-label'],
        ],
    ]); ?>

    <?= $form->field($formModel, 'text')->label("Новая задача") ?>

    <div class="form-group">
        <div class="col-lg-12 text-center report-button">
            <?= Html::submitButton("Добавить задачу", ['class' => 'btn btn-default', 'name' => 'add_task']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
