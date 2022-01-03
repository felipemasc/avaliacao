<?php
    //Biblioteca JSRequire
    require('php/Utils.php');
    //Conexão com banco de dados
    require('php/Database.php');
    // Chama o módulo e o arquivo
    if(!empty($_REQUEST['mdl']) && !empty($_REQUEST['file'])) {


        require("pages/{$_REQUEST['mdl']}/{$_REQUEST['file']}");

    } else {

    
        require('pages/header.php');
        require('pages/menu.php');

        echo '<main role="main" class="container">';
        //Chama a página
        if(!empty($_REQUEST['page'])) {
            // Páginas predefinidas
            switch($_REQUEST['page']) {
    
                case 'relVeiculo':
                    require('pages/relVeiculo/veiculo.php');
                    JSRequire('relVeiculo', 'RelVeiculo.js');
                    break;
    
                case 'relFuncionario':
                    require('pages/relFuncionario/funcionario.php');
                    JSRequire('relFuncionario', 'RelFuncionario.js');
                    break;

                case 'relRastreamento':
                    require('pages/relRastreamento/rastreamento.php');
                    JSRequire('relRastreamento', 'RelRastreamento.js');
                    break;


            }
    
        } else {
            require('pages/home/home.php');
        }
        
        echo '</main>';
        require('pages/footer.php');
    }