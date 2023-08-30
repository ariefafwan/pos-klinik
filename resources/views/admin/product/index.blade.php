@extends('admin.partials.app')
@section('body')

@if ($errors->any())
    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i>&nbsp;
        <div>
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-8">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-circle"></i>&nbsp;Tambah Data</button>
                            <!-- Button trigger modal -->
                            {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importmodal"><i class="bi bi-arrow-down-circle"></i>&nbsp;Import Data </button> --}}
                            {{-- <a href="{{ route('data.export') }}" class="btn btn-success"><i class="bi bi-cloud-upload-fill" target="_blank"></i>&nbsp;Export Data </a> --}}
                        </div>
                    </div>
                    <hr>                    
                    @include('admin.product.create')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label>Pilih Tipe Produk</label>
                                    <select class="form-select tipe" name="">
                                        @foreach ($type as $index)
                                        <option value="{{ $index->type }}">{{ $index->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Produk</th>
                                            <th>Tipe</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stock</th>
                                            <th>Diperbarui</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $index => $row)
                                        <tr>
                                            <td align="center" scope="row">{{ $product->count() * ($product->currentPage() - 1) + $loop->iteration }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->type }}</td>
                                            <td>{{ $row->harga_beli }}</td>
                                            <td>{{ $row->harga_jual }}</td>
                                            <td>{{ $row->stock }}</td>
                                            <td>{{ $row->ProductDate }}</td>
                                            <td align="center" class="d-flex justify-content-evenly">
                                                <a href="#!" class="btn btn-warning edit" data-id="{{ $row->id }} data-bs-toggle="modal" data-bs-target="#editModal">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-danger" onclick="event.preventDefault();
                                                            document.getElementById('product-delete-form-{{ $row->id }}').submit();">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                                <form id="product-delete-form-{{$row->id}}"
                                                    action="{{ route('product.destroy', $row->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <!-- Modal Import Excel-->
                    <div class="modal fade" id="importmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="{{ route('data.import') }}" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Import Data</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="file" id="file" name="file" required="required">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>&nbspClose</button>
                                        <button type="submit" class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>&nbspImport</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    @include('admin.product.edit')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
    //edit data
    $('.edit').on("click",function() {
    var id = $(this).attr('data-id');
    $.ajax({
    url: '/editproduct/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('#editid').val(data.id);
        $('#editname').val(data.name);
        $('#edithargabeli').val(data.harga_beli);
        $('#edithargajual').val(data.harga_jual);
        $('#edittype').val(data.type);
        $('#editstock').val(data.stock);
        $('#editModal').modal('show');
    }
    });
    });
    });
</script>
<script>
    $(document).ready(function() {
	    var table = $('#datatable').DataTable();
        
	    function filterData () {
		    $('#datatable').DataTable().search(
		        $('.tipe').val()
		    	).draw();
		}
		$('.tipe').on('change', function () {
	        filterData();
	    });
	});
</script>
@endsection