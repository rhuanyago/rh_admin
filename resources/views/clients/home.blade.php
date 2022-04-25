@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Clientes</h1>
@stop
@section('content')
    <section class="content">
        <div class="container-fluid">            
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <a href="#" data-toggle="modal" data-target="#modalClient" class="btn btn-sm bg-gradient-primary">
                                <i class="fa fa-plus"></i>
                                Novo Cliente
                            </a>
                        </div>

                        <div class="card-body">
                            <table id="clients" class="table table-hover table-bordered table-colored" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>CPF</th>
                                        <th>RG</th>
                                        <th>Date of Birth</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        @include('clients.modal.create')

    </section>
@stop

@section('plugins.Datatables', true)

@section('js')
<script>
var clients;

$(document).ready(function() {
    var clients = $('#clients').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        scrollCollapse: true,
        scrollX: true,
        ajax: {
            url: "{{ route('listClients') }}",
            type: "GET",
            async: true
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {"data": "document"},
            {"data": "document_secondary"},
            {"data": "date_of_birth"},
            {
                "data": "actions",
                "className": 'text-center'
            }
        ]
    });

    $("#date_of_birth").inputmask("99/99/9999",{ "placeholder": "dd/mm/yyyy" });
});
</script>
@endsection
