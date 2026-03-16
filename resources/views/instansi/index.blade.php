@extends('layouts.admin')

@section('title', 'Instansi')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Instansi</h3>

            </div>
            <div class=" card-header">
                <a href="{{ route('instansi.create') }}" class="btn btn-secondary">Input</a>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="col-1">Kode</th>
                            <th class="col-3">Nama</th>
                            <th class="col-3">Alamat</th>
                            <th class="col-2">Email</th>
                            <th class="col-2">Tlpn</th>
                            <th class="col-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($instansi as $i)
                            <tr>
                                <td class="text-center">{{ $i->code }}</td>
                                <td class="text-bold">{{ $i->nama }}</td>
                                <td>{{ $i->alamat }}</td>
                                <td>{{ $i->email }}</td>
                                <td class="text-center">{{ $i->tlpn }}</td>
                                <td class="text-center">
                                    <a href="{{ route('instansi.edit', $i->id) }}" class="btn btn-success btn-sm"><i
                                            class="fa fa-pen"></i></a> 
                                    <form id="delete-form-{{ $i->id }}" 
                                        action="{{ route('instansi.destroy',$i->id) }}" 
                                        method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $i->id }})"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="alert alert-danger mb-0">
                                        Data instansi belum ada.
                                    </div>
                                </td>
                            </tr>
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

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif


    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}'
            })
        </script>
    @endif

    <script>
        function confirmDelete(id) {

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {

                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }

            })

        }
    </script>
@endpush
