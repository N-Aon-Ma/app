<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
    <style>
        body {
            background: url(/backend/image/background.jpg) no-repeat;
            background-size: 100%;
        }
    </style>
    <div class="my-body"></div>
    <a href="/backend/site/create-apples">Создать яблоки</a>
<?php
foreach ($model as $apple) {
    ?>
    <div>
        <p>яблоко {<span style="color:<?= $apple->color ?>"><?= $apple->color ?></span>}:<?= $apple->size ?>
            :<?= $apple->getStateText() ?>
            <a href="<?= \yii\helpers\Url::to(['/site/eat-apple', 'id' => $apple->id]) ?>">Откусить</a>
            <a href="<?= \yii\helpers\Url::to(['/site/fall-apple', 'id' => $apple->id]) ?>">Сбросить с дерева</a>
            <a href="<?= \yii\helpers\Url::to(['/site/delete-apple', 'id' => $apple->id]) ?>">Удалить</a>
        </p>
    </div>
    <?
}

?>