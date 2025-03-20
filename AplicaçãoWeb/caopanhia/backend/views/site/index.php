<?php

use yii\helpers\Html;

$this->title = 'Dashboard';

$anuncios = \common\models\Anuncios::find()->where(['dataAdocao' => null])->count();
$pedidosConsulta = \common\models\Caes::find()->where(['pedidoConsulta' => 1])->count();
$percentagemAnuncios = round($pedidosConsulta/$anuncios * 100, 0).'%';
$anunciosHoje = 0;
foreach (\common\models\Anuncios::find()->all() as $anuncio){
    $dataAnuncio = new DateTime($anuncio->dataCriacao);
    $data = $dataAnuncio->format('Y-m-d');
    if ($data == date('Y-m-d')){
        $anunciosHoje++;
    }
}

$marcacoes = \common\models\Marcacoesveterinarias::find()->where(['>=' ,'data', date('Y-m-d')])->count();
$marcacoesDoDia = \common\models\Marcacoesveterinarias::find()->where(['=' ,'data', date('Y-m-d')])->count();
if ($marcacoes == 0){
    $percentagemMarcacoes = '0%';
}else{
    $percentagemMarcacoes = round($marcacoesDoDia/$marcacoes * 100, 0).'%';
}
$marcacoesOntem = \common\models\Marcacoesveterinarias::find()->where(['data' => date('Y-m-d',strtotime("-1 days"))])->count();

$encomendas = \common\models\Encomendas::find()->where(['finalizada' => 'sim'])->count();
$encomendasEntregues = \common\models\Encomendas::find()->where(['estado' => 'entregue'])->count();
$percentagemEncomendas = round($encomendasEntregues/$encomendas * 100, 0).'%';
$encomendasHoje = 0;
foreach (\common\models\Encomendas::find()->where(['finalizada' => 'sim'])->all() as $encomenda){
    $dataEncomenda = new DateTime($encomenda->data);
    $data = $dataEncomenda->format('Y-m-d');
    if ($data == date('Y-m-d')){
        $encomendasHoje++;
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Bem vindo!</h3>',
            ]) ?>
        </div>
    </div>

    <h5>Vista geral</h5><br>


    <div class="row">

        <div class="col-md-4 col-sm-6 col-12">
            <?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Anúncios de cão para adoção',
                'number' => $anuncios,
                'theme' => 'yellow',
                'icon' => 'far fa-star',
                'progress' => [
                    'width' => $percentagemAnuncios,
                    'description' => $pedidosConsulta.' com pedido de consulta ('.$percentagemAnuncios.')'
                ]
            ]) ?><a href="<?= \yii\helpers\Url::to(['marcacoesveterinarias/indexpedidos']) ?>" class="small-box-footer">
                <i class="fas fa-arrow-circle-right"></i>
            </a>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Consultas veterinárias marcadas',
                'number' => $marcacoes,
                'theme' => 'orange',
                'icon' => 'far fa-heart',
                'progress' => [
                    'width' => $percentagemMarcacoes,
                    'description' => $marcacoesDoDia.' para hoje ('.$percentagemMarcacoes.')'
                ]
            ]) ?><a href="<?= \yii\helpers\Url::to(['marcacoesveterinarias/index']) ?>" class="small-box-footer">
                <i class="fas fa-arrow-circle-right"></i>
            </a>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>


        <div class="col-md-4 col-sm-6 col-12">
            <?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Encomendas',
                'number' => $encomendas,
                'theme' => 'info',
                'icon' => 'far fa-envelope',
                'progress' => [
                    'width' => $percentagemEncomendas,
                    'description' => $encomendasEntregues.' entregues ('.$percentagemEncomendas.')'
                ]
            ]) ?><a href="<?= \yii\helpers\Url::to(['encomendas/index']) ?>" class="small-box-footer">
                <i class="fas fa-arrow-circle-right"></i>
            </a>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>

    </div>
    <div class="row">

        <div class="col-md-4 col-sm-6 col-12">
            <?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Anúncios postados hoje',
                'number' => $anunciosHoje,
                'theme' => 'yellow',
                'icon' => 'far fa-star',
            ]) ?>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Consultas realizadas ontem',
                'number' => $marcacoesOntem,
                'theme' => 'orange',
                'icon' => 'far fa-heart',
            ]) ?>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>


        <div class="col-md-4 col-sm-6 col-12">
            <?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Encomendas feitas hoje',
                'number' => $encomendasHoje,
                'theme' => 'info',
                'icon' => 'far fa-envelope',

            ]) ?>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>

    </div>

    <img src="<?= \yii\helpers\BaseUrl::to('/caopanhia/backend/web/images/mapaPortugal.jpg')?>" alt="Sede Caopanhia">
</div>