<div class="jumbotron">
    <div class="row">
        <div class="col-3">
            <div id="divInputPlaca"></div>
        </div>
        <div class="col-3">
            <div id="divInputFuncionario"></div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-6">
                    <div id="divInputDataInicial"></div>
                </div>
                <div class="col-6">
                    <div id="divInputDataFinal"></div>
                </div>
            </div>
            <div id="divInputData"></div>
        </div>
        <div class="col-2">
            <div id="divBtnConsultar"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div id="divCmpGridRastreamento"></div>
        </div>
    </div>
</div>


<style type="text/css">
    .jumbotron {
        padding: 32px;
    }

    #divInputPlaca, #divBtnConsultar {
        display: inline-block;
        vertical-align: top;
    }

    #divBtnConsultar {
        margin-top: 32px;
        margin-left: 10px;
    }

    #divCmpGridVeiculo {
        display: inline-block;
        width: 100%;
        margin-bottom: 20px;
    }
</style>

<script type="text/javascript">


    Cmp.ready(function() {
     new Cmp.RelRastreamento().init();
    });

</script>