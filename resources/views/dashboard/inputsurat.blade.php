   @extends('layouts.admin')

   @section('title', 'DataTables')

   @section('content')
   <div class="card card-primary">
       <div class="card-header">
           <h3 class="card-title">Tambah Data Surat MAsuk</h3>
       </div>
       <!-- /.card-header -->
       <!-- form start -->
       <form action="{{route('simpansurat')}}" method="POST" enctype="multipart/form-data">
        @csrf
           <div class="card-body">
               <div class="form-group">
                   <label for="exampleInputEmail1">Nomor Surat</label>
                   <input type="text" name="nomor_surat" class="form-control" id="exampleInputEmail1" placeholder="Masukan nomor surat">
               </div>
               <div class="form-group">
                   <label for="exampleInputPassword1">Tanggal Surat </label>
                   <input type="date" name="tanggal_surat" class="form-control" id="exampleInputPassword1" placeholder="Tanggal Surat">
               </div>
               <div class="form-group">
                   <label for="exampleInputPassword1">Pengirim </label>
                   <input type="text" name="pengirim" class="form-control" id="exampleInputPassword1" placeholder="Pengirim">
               </div>
               <div class="form-group">
                   <label for="exampleInputPassword1">Perihal </label>
                   <input type="Text" name="perihal" class="form-control" id="exampleInputPassword1" placeholder="Perihal">
               </div>
               <div class="form-group">
                   <label for="exampleInputPassword1">Tujuan </label>
                   <input type="Text" name="tujuan" class="form-control" id="exampleInputPassword1" placeholder="Perihal">
               </div>
               <div class="form-group">
                   <label for="exampleInputFile">File input</label>
                   <div class="input-group">
                       <div class="custom-file">
                           <input type="file" name="file_surat" class="custom-file-input" id="exampleInputFile">
                           <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                       </div>
                       <div class="input-group-append">
                           <span class="input-group-text">Upload</span>
                       </div>
                   </div>
               </div>
               <!-- <div class="form-check">
                   <input type="checkbox" class="form-check-input" id="exampleCheck1">
                   <label class="form-check-label" for="exampleCheck1">Check me out</label>
               </div> -->
           </div>
           <!-- /.card-body -->

           <div class="card-footer">
               <button type="submit" class="btn btn-primary">Submit</button>
           </div>
       </form>
   </div>
   <!-- /.card -->

   <!-- general form elements -->
   @endsection