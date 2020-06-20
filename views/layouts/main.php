<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    NavBar::begin([
        'brandLabel' => 'SAGHA',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if( Yii::$app->user->isGuest){
        $usuario = "nada";
        Yii::$app->homeUrl = '/site/index';

        $linksFormatado = [
                ['label' => "Pagina inicial", 'url' => ['/site/index']],
        ];
    }else if(Yii::$app->user->identity->tipo_usuario == 1){
        Yii::$app->homeUrl = '/datas-professor';
        $linksFormatado = [
                ['label' => "Datas Disponiveis", 'url' => ['/datas-professor']],
                ['label' => "Diciplinas Aderentes", 'url' => ['/disciplinas-professor']]
        ];

    }else if(Yii::$app->user->identity->tipo_usuario == 2){
        Yii::$app->homeUrl = '/aula-coordenador';
        $linksFormatado = [
            ['label' => "Suas Aulas", 'url' => ['/aula-coordenador']]
        ];
    }
    else if(Yii::$app->user->identity->tipo_usuario == 3){
        Yii::$app->homeUrl = '/aula-coordenador';
        $linksFormatado = [
            ['label' => "Usuarios", 'url' => ['/usuario']],
            ['label' => "Professores", 'url' => ['/professor']],
            ['label' => "Coordenadores", 'url' => ['/coordenador']],
            ['label' => "Unidades", 'url' => ['/unidade']],
            ['label' => "Cursos", 'url' => ['/curso']],
            ['label' => "Diciplinas", 'url' => ['/disciplinas']],
            ['label' => "Aulas", 'url' => ['/aula']],
        ];
    }

    array_push($linksFormatado,Yii::$app->user->isGuest ? (
    ['label' => 'Login', 'url' => ['/site/login']]
    ) : (
        '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>'
    ));



    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $linksFormatado
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; SAGHA <?= date('Y') ?></p>

        <p class="pull-right">Criado por: Alexandre Fernandes Manso |
                                          Junio Hyago Jorge da Mata |
                                          Thulio Thalles Amaral Carneiro.
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
