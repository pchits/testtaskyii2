<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\console\widgets\Table;

$this->title = 'Games Results'; 
?>
<h1>Past Games</h1>

<?= GridView::widget([
        'dataProvider' => $games,
    ]); ?>
    