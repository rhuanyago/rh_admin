@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Clientes</h1>
@stop
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-button label="Primary" theme="primary" icon="fas fa-key"/>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Clientes Cadastrados</h3>
                        </div>

                        <div class="card-body">
                            <table id="clients" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
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

    </section>
@stop

@section('plugins.Datatables', true)

@section('js')
<script>
$(document).ready(function() {
    $('#clients').DataTable({
        processing: true,
        serverSide: true,
        "ajax": "{{ route('listClients') }}",
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
});
</script>
@endsection
