@extends('layouts.admin')

@section('title', 'DataTables')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Surat</h3>

        </div>
        <div class=" card-header">
            <a href="{{route('inputsurat')}}" class="btn btn-secondary">Input</a>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nomor Surat</th>
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th>Tujuan</th>
                        <th>Tanggal diterima</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datasurat as $d)
                    <tr>
                        <td>{{$d->tangal_surat}}</td>
                        <td>{{$d->nomor_surat}}</td>
                        <td>{{$d->pengirim}}</td>
                        <td>{{$d->perihal}}</td>
                        <td>{{$d->tujuan}}</td>
                        <td>{{$d->created_at}}</td>
                        <td>
                            @if($d->stauts == 'baru')
                            <span class="badge badge-primary">Baru</span>
                            @elseif($d->stauts == 'disposisi')
                            <span class="badge badge-secondary">Disposisi</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ asset('storage/'.$d->file_surat) }}" target="_blank">
                                Lihat File
                            </a>
                        </td>
                        <td>
                            <form action="post" method="POST">
                                <button type="button" class="btn btn-primary btn-sm btn-disposisi" data-toggle="modal" data-target="#modal-default" data-nomor="{{ $d->nomor_surat }}" data-id="{{$d->id}}">
                                  <i class="fa fa-paper-plane"></i>
                                </button>
                                @csrf
                                <a href='#' class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                <a href='#' class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                            </form>
                        </td>
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
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
           <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('simpandisposisi') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="surat_masuk_id" id="surat_id_modal">
                    <label for="exampleInputEmail1">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat_modal" placeholder="" readonly>
                  </div>
                  <!-- sementara -->
                   <div class="form-group">
                    <label for="exampleInputPassword1">Dari Ke</label>
                    <input type="text" class="form-control" name="dari_user_id" id="" placeholder="">
                  </div>
                   <!-- end sementara -->
                  <div class="form-group">
                    <label for="exampleInputPassword1">Ditujukan Ke</label>
                    <input type="text" class="form-control" name="ke_user_id" id="" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">isi disposisi</label>
                    <!-- <input type="text" class="form-control" name="isi_disposisi" id="" placeholder=""> -->
                    <textarea name="isi_disposisi" class="form-control" id=""></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Batas Waktu</label>
                    <input type="date" class="form-control" name="batas_waktu" id="" placeholder="">
                  </div>
                </div>
                <!-- /.card-body -->

                {{-- <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> --}}
             
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button> 
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


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
    $(function() {
        $("#example1").DataTable({
            responsive: true,
            autoWidth: false,
            order: [
                [0, "desc"]
            ],
            dom: "<'row mb-2'" +
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
<script>
$(document).on('click', '.btn-disposisi', function () {
    let nomorSurat = $(this).data('nomor');
    let idSurat = $(this).data('id');
    $('#nomor_surat_modal').val(nomorSurat);
    $('#surat_id_modal').val(idSurat);
});
</script>

@endpush