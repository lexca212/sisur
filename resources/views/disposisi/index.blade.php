@extends('layouts.admin')

@section('title', 'Disposisi')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Disposisi</h3>

            </div>
            <div class=" card-header">
                <a href="{{ route('inputsurat') }}" class="btn btn-secondary">Input</a>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal Disposisi</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($disposisi as $d)
                            <tr>
                                <td>{{ $d->created_at->format('d/m/Y') }}</td>
                                <td>{{ $d->suratMasuk->pengirim }}</td>
                                <td>{{ $d->suratMasuk->perihal }}</td>
                                <td>
                                    {{-- Menampilkan Badge sesuai warna di controller kamu --}}
                                    @if ($d->status == 'menunggu')
                                        <span class="badge" style="background-color: #f39c12; color: white;">Pending</span>
                                    @elseif($d->status == 'diproses')
                                        <span class="badge" style="background-color: #007bff; color: white;">Diproses</span>
                                    @else
                                        <span class="badge" style="background-color: #28a745; color: white;">Selesai</span>
                                    @endif0
                                </td>
                                <td>
                                    <div class="btn-group">
                                        {{-- Tombol ke Process (Biru) --}}
                                        @if ($d->status == 'menunggu')
                                            <form action="{{ route('disposisi.updateStatus', $d->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="diproses">
                                                <button type="submit" class="btn btn-sm btn-primary mr-1">Proses</button>
                                            </form>
                                        @endif

                                        {{-- Tombol ke Done (Hijau) --}}
                                        @if ($d->status == 'diproses')
                                            <form action="{{ route('disposisi.updateStatus', $d->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit" class="btn btn-sm btn-success">Selesai</button>
                                            </form>
                                        @endif

                                        @if ($d->status == 'selesai')
                                            <small class="text-muted"><i class="fas fa-check-double"></i> Selesai</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $d->suratMasuk->file_surat) }}"
                                        class="btn btn-sm btn-warning" target="_blank">
                                        Lihat File
                                    </a>
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
@endpush
