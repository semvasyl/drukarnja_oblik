<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Друкарня',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Головна', 'url' => ['/site/index']],

            ['label' => 'Менеджер',
                'items' => [
                    ['label' => 'Додати замовлення', 'url' => ['/orders/create']],
                    ['label' => 'Мої роботи', 'url' => ['/orders']],
                ]
            ],        

            ['label' => 'Друкар',
                'items' => [
                    ['label' => 'Нові поступлення', 'url' => ['/site/about']],
                    ['label' => 'Мої роботи', 'url' => ['/site/contact']],
                ]
            ],

            ['label' => 'Бух/Кер',
                'items' => [
                    ['label' => 'Виконані роботи', 'url' => ['/site/contact']],
                ]
            ],

            ['label' => 'Довідники',
                'items' => [
                    ['label' => 'Замовники', 'url' => ['/customers/index']],
                    ['label' => 'Кліше', 'url' => ['/cliche/index']],
                    ['label' => 'Історії', 'url' => ['/history/index']],
                ]
            ],

            ['label' => 'Користувачі',
                'items' => [
                    ['label' => 'Користувачі', 'url' => ['/user-editor/index']],
                    ['label' => 'Ролі доступу', 'url' => ['/permit/access/role']],
                    ['label' => 'Присвоєння ролей', 'url' => ['/permit/user/view']],
                    ['label' => 'Права доступу', 'url' => ['/permit/access/permission']],

                    
                ]
            ],


            ['label' => 'Допомога',
                'items' => [
                    ['label' => 'Контакт', 'url' => ['/site/contact']],
                    ['label' => 'Про систему', 'url' => ['/site/about']],
                ]
            ],

            Yii::$app->user->isGuest ?
                ['label' => 'Увійти', 'url' => ['/site/login']] :
                [
                    'label' => 'Вийти (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Друкарня <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
