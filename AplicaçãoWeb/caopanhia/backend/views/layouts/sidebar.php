<?php

use common\models\User;

$user = User::find()->where(['id' => Yii::$app->user->getId()])->one();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::to(['site/login']) ?>" class="brand-link">
        <img src="<?= \yii\helpers\BaseUrl::to('/caopanhia/backend/web/images/logoCaopanhia.png')?>" alt="Caopanhia Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
        <span class="brand-text font-weight-light">CÃOPANHIA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= \yii\helpers\BaseUrl::to('/caopanhia/backend/web/images/userIcon')?>" class="img-circle elevation-2" alt="Utilizador">
            </div>
            <div class="info">
                <a href="<?= \yii\helpers\Url::to(['user/view', 'id' => $user->id,'role' => $user->getRoleName()]) ?>" class="d-block"><?= \common\models\Userprofile::find()->where(['idUser' => Yii::$app->user->getId()])->one()->nome ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Dashboard', 'url' => ['site/login'], 'icon' => 'home'],
                    ['label' => 'Loja', 'header' => true],
                    ['label' => 'Encomendas Realizadas','url'=>['encomendas/index'], 'icon' => 'archive'],
                    ['label' => 'Gestão de Produtos','url'=>['produtos/index/', 'filtro' => 0], 'icon' => 'shopping-cart'],
                    ['label' => 'Tipos de Porduto', 'url'=>['categorias/index'], 'icon' => 'tags'],
                    ['label' => 'Consultas','header' => true],
                    ['label' => 'Marcar consultas', 'url' => ['marcacoesveterinarias/indexpedidos'], 'icon' => 'heartbeat'],
                    ['label' => 'Consultas marcadas', 'url' => ['marcacoesveterinarias/index'], 'icon' => 'calendar-check'],
                    ['label' => 'Histórico de consultas', 'url' => ['marcacoesveterinarias/indexhistorico'], 'icon' => 'history'],
                    ['label' => 'Gestão de Métodos', 'header' => true],
                    ['label' => 'Métodos de Pagamemto', 'url' => ['tipospagamento/index'], 'icon' => 'credit-card'],
                    ['label' => 'Métodos de Expedição', 'url' => ['tiposexpedicao/index'], 'icon' => 'truck'],
                    ['label' => 'Distritos', 'header' => true],
                    ['label' => 'Gestão dos Distritos', 'url' => ['distritos/index'], 'icon' => 'map-pin'],
                    ['label' => 'Raças', 'header' => true],
                    ['label' => 'Gestão das Raças', 'url' => ['racas/index'],'icon' => 'paw'],
                    ['label' => 'Questionário', 'url' => ['questionario/index'], 'icon' => 'list-ol'],
                    ['label' => 'Utilizadores', 'header' => true],
                    [ 'label' => 'Gestão de Funcionários',
                        'icon' => 'user-plus',
                        'items' => [
                            ['label' => 'Administradores','url' => ['user/index', 'role' => 'admin'], 'icon' => 'user'],
                            ['label' => 'Gestores','url' => ['user/index', 'role' => 'gestor'], 'icon' => 'user'],
                            ['label' => 'Veterinários','url' => ['user/index', 'role' => 'vet'], 'icon' => 'user']
                        ]],
                    ['label' => 'Lista de Clientes', 'url' => ['user/index', 'role' => 'client'], 'icon' => 'users'],
                    //['label' => 'Framework YII2', 'header' => true],
                    //['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                   // ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                   // ['label' => 'Sessão', 'header' => true],
                    //['label' => 'Terminar sessão', 'url' => ['site/logout'], ['data-method' => 'post'], 'icon' => 'sign-out-alt'],
                    //['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    /*['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    ['label' => 'Level1'],
                    [
                        'label' => 'Level1',
                        'items' => [
                            ['label' => 'Level2', 'iconStyle' => 'far'],
                            [
                                'label' => 'Level2',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],
                            ['label' => 'Level2', 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Level1'],
                    ['label' => 'LABELS', 'header' => true],
                    ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],*/
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>