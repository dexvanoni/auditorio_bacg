@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <img src="/imagens/auditorio.png" width="150px" height="150px" class="img-fluid">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agendamento do Auditório da BACG</div>

                <div class="card-body">
                    <div class="row align-items-center">
                         <div class="col-auto">
                            <img src="/imagens/calendario.png" width="50px" height="50px">
                          </div>
                        <h6>
                            Pesquise a data pretendida
                        </h6>
                    </div>    
                          <hr>
                          <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <strong>Data do Evento</strong>
                                    <input type="date" class="form-control" name="data_evento" id="datapesquisa" placeholder="Data do Evento">
                                </div>
                                <div class="col">
                                    <strong>Início</strong>
                                    <input type="time" class="form-control" name="hora_inicio" id="iniciopesquisa">
                                </div>
                                <div class="col">
                                    <strong>Término</strong>
                                    <input type="time" class="form-control" name="hora_termino" id="terminopesquisa">
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-primary" onclick="pesquisa_data();">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                          </div>
                        <label id="resultadosPesquisa"></label>
                    <div class="divResultados" id="divResultados">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                                <hr>

                                

                                    <div class="form-group row">
                                        <div class="col-md-7 offset-md-5">
                                            <button type="submit" class="btn btn-primary" id="btnSubmit">
                                                CADASTRAR
                                            </button>
                                        </div>
                                    </div>
                                <hr>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //PESQUISA DE DATA
    function pesquisa_data() {

        var data_pesquisa = $('#datapesquisa').val();
        var inicio_pesquisa = $('#iniciopesquisa').val();
        var termino_pesquisa = $('#terminopesquisa').val();

        var dados = {
            data_pesquisa: data_pesquisa,
            inicio_pesquisa: inicio_pesquisa,
            termino_pesquisa: termino_pesquisa
        };

        $.ajax({
            url: '{{ route("pesquisa") }}',
            type: 'GET',
            dataType: 'json',
            //data: { termo_pesquisa: $('#termoPesquisa').val() }, // Adicione o parâmetro aos dados
            data: dados,
            success: function (data) {
                try {
                    exibirResultados(data);
                    // Habilitar ou desabilitar o botão de envio com base nos resultados
                    $('#btnSubmit').prop('disabled', data.length === 0);
                } catch (e) {
                    console.error("Erro ao processar dados JSON: ", e);
                }
            },
            error: function (xhr, status, error) {
                console.error("Erro na requisição AJAX: ", error);
                console.log("Resposta do servidor:", xhr.responseText);
            }
        });

        function exibirResultados(resultados) {
            var listaResultados = $('#resultadosPesquisa');
            listaResultados.empty();

            // Verificar se resultados é uma coleção iterável
            if (Array.isArray(resultados) && resultados.length > 0) {
                $('#btnSubmit').prop('enable');
                // Iterar sobre os resultados
                resultados.forEach(function (resultado) {
                    // Verificar se o campo nome está vazio
                    //var nomeAluno = 'DATA/HORA INDISPONÍVEL';

                    listaResultados.append('<li style="color: red"> HORÁRIO NÃO DISPONÍVEL PARA AGENDAMENTO! </li>');
                    // Preencher os inputs com os valores
                    //$('#nome_aluno_resp').val(nomeAluno);
                    //$('#cpf_aluno_resp').val(termoPesquisa);
                });

                // Exibir a div se houver resultados
                console.log('achou');
                $('#divResultados').show();
            } else {
                console.log('vazio');
                $('#divResultados').show();
                listaResultados.append('<li style="color: green"> HORÁRIO LIVRE! </li>');
                // Ocultar a div se não houver resultados
                //$('#divResultados').hide();
            }
        }
    };
</script>
@endsection
