<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ctel */

$this->title = 'Create Ctel';
$this->params['breadcrumbs'][] = ['label' => 'Ctels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
