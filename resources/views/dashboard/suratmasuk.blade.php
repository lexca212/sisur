@extends('layouts.admin')

@section('title', 'DataTables')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contoh DataTables</h3>
           
        </div>
         <div class=" card-header">
                <a href="{{route('inputsurat')}}" class="btn btn-secondary">Input</a>
            </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>sa</th>
                        <th>as</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datasurat as $d)
                    <tr>
                        <td>{{$d->pengirim}}</td>
                        <td>{{$d->perihal}}</td>
                        <td>ss</td>
                        <td>ss</td>
                    </tr>
                    @empty
                    <div class="alert alert-danger">
                        Data surat belum ada.
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- DataTables & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<script>
    $(function () {
    $("#example1").DataTable({
        responsive: true,
        autoWidth: false,
        order: [[0, "desc"]],
        dom:
            "<'row mb-2'" +
                "<'col-sm-6'l>" +
                "<'col-sm-6 text-right'f>" +
            ">" +
            "<'row'" +
                "<'col-sm-12'tr>" +
            ">" +
            "<'row mt-2'" +
                "<'col-sm-5'i>" +
                "<'col-sm-7'p>" +
            ">"
    });
});
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
   
</script>
@endpush