<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ctel */

$this->title = 'Update Ctel: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ctels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->client_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ctel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
