Cmp.RelRastreamento = function() {
    
    var private = {

        render: function() {

            Cmp.createInput({
                id: 'inputPlaca',
                renderTo: '#divInputPlaca',
                label: 'Placa do veículo',
                width: '100%'
            });

            Cmp.createInput({
                id: 'inputFuncionario',
                renderTo: '#divInputFuncionario',
                label: 'Nome do funcionário',
                width: '100%'
            });

            Cmp.createInput({
                id: 'inputDatainicial',
                renderTo: '#divInputDataInicial',
                label: 'Data inicial',
                width: '100%',
                type: 'date'
            });
            
            Cmp.createInput({
                id: 'inputDatafinal',
                renderTo: '#divInputDataFinal',
                label: 'Data final',
                width: '100%',
                type: 'date'
            });

            Cmp.createButton({
                id: 'btnBuscar',
                renderTo: '#divBtnConsultar',
                text: 'Buscar',
                handler: function() {
                    private.buscar();
                }
            });

            Cmp.createGrid({
                id: 'gridDadosRastreamentos',
                renderTo: '#divCmpGridRastreamento',
                header: [
                    {
                        text: 'Placa',
                        field: 'placa'
                    }
                    ,{
                        text: 'Funcionário',
                        field: 'funcionario',
                        width: 150
                    }
                    ,{
                        text: 'Data',
                        field: 'data',
                        width: 150
                    }
                    ,{
                        text: 'Vel. Max.',
                        field: 'vel_maxima',
                        width: 150
                    }
                    ,{
                        text: 'Vel. Reg.',
                        field: 'vel_registrada',
                        width: 150
                    }
                    ,{
                        text: 'Diff. Vel.',
                        field: 'vel_diff',
                        width: 150
                    }
                    ,{
                        text: 'Latitude',
                        field: 'latitude',
                        width: 150
                    }
                    ,{
                        text: 'Longitude',
                        field: 'longitude',
                        width: 150
                    }
                ]
            });
        },

        buscar: function() {
            Cmp.showLoading();

            Cmp.request({
                url: 'index.php?mdl=relRastreamento&file=ds_rastreamento.php',
                params: {
                    placa: Cmp.get('inputPlaca').getValue()
                    ,funcionario: Cmp.get('inputFuncionario').getValue()
                    ,datainicial: Cmp.get('inputDatainicial').getValue()
                    ,datafinal: Cmp.get('inputDatafinal').getValue()
                },
                success: function(res) {
                    Cmp.hideLoading();
                    if(res.status == 'success') {
                        Cmp.get('gridDadosRastreamentos').loadData(res.data);
                    } else {
                        Cmp.get('gridDadosRastreamentos').loadData(res.data);
                        Cmp.showErrorMessage(res.message || 'Ocorreu um erro na requisição');
                    }
                }
            });
        }

    };

    this.init = function() {
        private.render();
    }

}