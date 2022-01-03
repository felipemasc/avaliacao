<?php

function ajustaDataParaIf($valor) : int
{
   return str_replace('-', '', $valor);
}

function checkData($data) : bool
{
    return checkdate((int)substr($data,5,2),(int)substr($data,8,2),(int)substr($data,0,4));
}

$where = '';

if(!empty($_REQUEST['placa'])) {
    $where = "AND v.placa LIKE '%{$_REQUEST['placa']}%'";
}

if(!empty($_REQUEST['funcionario'])) {
    $where .= " AND f.nome LIKE '%{$_REQUEST['funcionario']}%'";
}

if ( !empty($_REQUEST['datainicial']) ) { 
    if ( !checkData($_REQUEST['datainicial']) ) {
        echo json_encode(array(
            'status' => 'failure',
            'message' => 'Data inicial está inválida.'
        ));
        exit();
        
    } 
    $where .= " and r.data >= '".$_REQUEST['datainicial']."'";
}

if ( !empty($_REQUEST['datafinal']) ) { 
    if ( !checkData($_REQUEST['datafinal']) ) {
        echo json_encode(array(
            'status' => 'failure',
            'message' => 'Data inicial está inválida.'
        ));
        exit();
        
    } 
    $where .= " and r.data >= '".$_REQUEST['datafinal']."'";
}

if ( !empty($_REQUEST['datainicial']) and !empty($_REQUEST['datafinal'])  ) {
    if ( ajustaDataParaIf($_REQUEST['datainicial']) > ajustaDataParaIf($_REQUEST['datafinal']) ) {
        echo json_encode(array(
            'status' => 'failure',
            'message' => 'Data inicial deve ser menor que final.'
        ));
        exit();
    }
}

$db = new Database();

if($db->connect()) {

    $dados = $db->sqlQueryArray(
        "SELECT
            v.placa,
            f.nome AS funcionario,
            r.data,
            v.vel_maxima,
            r.vel_registrada,
            -- Adiciona símbolo de porcentagem
            CONCAT( 
                -- (((vel_registrada×100)÷vel_maxima)−100)
                ROUND( ( ( ( r.vel_registrada*100)/v.vel_maxima ) - 100 )
            ), '', '%') AS vel_diff,
            r.latitude,
            r.longitude
        
        FROM rastreamento r
        INNER JOIN veiculo v ON v.id = r.veiculo_id
        INNER JOIN funcionario f ON f.id = r.funcionario_id

        WHERE 
            r.vel_registrada > v.vel_maxima
        {$where}"
    );

    if ( !$dados ) {
        echo json_encode(array(
            'status' => 'failure',
            'data' => $dados,
            'message' => 'Não foi encontrado resultados para sua pesquisa'
        ));
        exit();
    }

    echo json_encode(array(
        'status' => 'success',
        'data' => $dados
    ));

    

} else {
    echo json_encode(array(
        'status' => 'failure',
        'message' => 'Erro ao conectar ao banco'
    ));
}