<?php
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $comments yii\db\ActiveQuery */

Pjax::begin(['id' => 'pjax-container']);
$dataProvider = new ActiveDataProvider([
    'query' => $comments,
]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'comment_author',
        'comment_content',
        [
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a('', 
                    Url::to(['post/deletecomment', 'id' => $data->comment_post_id, 'comment_id' => $data->comment_id]), 
                    [
                        'class' => 'glyphicon glyphicon-trash',
                        'data-confirm' => 'Are you sure you want to delete this item?',
                        'title' => 'Delete',
                        'aria-label' => 'Delete',
                        'data-method' => 'post',
                        'data-pjax' => 'pjax-container',                        
                    ]);


            }
        ] 
    ]
]);
Pjax::end();