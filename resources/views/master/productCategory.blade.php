@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')

@endsection
<!-- css -->
@section('add_css')

@endsection
<!-- content -->
@section('content')
<!-- modal edit -->
<div class="modal fade" id="modalAdd" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content" style="border-radius: 17px;">
    <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
      <h4 style="color:white;">Add Product Category</h4>
      <button type="button" class="close" 
      data-dismiss="modal" 
      aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <FORM method="post" action="<?php echo URL::to('/kecamatan/edit')?>">
        <div class="form-group">
          <label>Category Name:</label>
          <input type="text" class="form-control" id="txtCategoryName" name="txtCategoryName" placeholder="Category Name" required>
          <label>Minimal</label>
          <select class="form-control select2" style="width: 100%;">
            <option selected="selected">Alabama</option>
            <option>Alaska</option>
            <option>California</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option>
          </select>
        </div>
        <div class="form-group">
          <input type="hidden" name="_token" value="{!!csrf_token()!!}">
          <button class="btn btn-danger">Add</button>
        </div>
      </FORM>
    </div>
  </div>
</div>
</div>
<!-- tutup modal edit-->
<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Master Product Category</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Master Product Category</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-1 col-4" data-toggle="tooltips" title="Add">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd" data-toggle="modal" 
              data-target="#modalAdd"><i class="fa fa-plus-circle nav-icon"></i> Add</button>
            </div>
            <div class="col-lg-1 col-4" data-toggle="tooltips" title="Delete">
              <button type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-times-circle nav-icon"></i> Delete</button>
            </div>
            <div class="col-lg-1 col-4" data-toggle="tooltips" title="Filter">
              <button type="button" class="btn btn-block btn-secondary btn-sm"><i class="fa fa-filter nav-icon"></i> Filter</button>
            </div>

           <!--  <div class="col-lg-4 col-4">
              <label>
                <input type="checkbox" class="flat-red" checked>
              </label>
              <label>
                <input type="checkbox" class="flat-red">
              </label>
              <label>
                <input type="checkbox" class="flat-red" disabled>
                Flat green skin checkbox
              </label>
            </div>

            <div class="col-lg-4 col-4">
              <label>Minimal</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div> -->

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12 col-md-6">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                        No
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 70%;">
                        Name
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 25%;">
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pCategory as $key => $value) 
                    <tr>

                      <td style="text-align: center;">{{$value->no}}</td>

                      <td>{{$value->name}}</td>
                      <td>
                        <div class="form-group">
                          <div>
                            <!-- <button 
                            type="button" 
                            class="btn btn-warning" 
                            data-toggle="modal" 
                            data-target="#modalEdit"
                            id="{{$value->id}}"
                            data-id = "{{$value->id}}"
                            data-nama="{{$value->name}}">
                            edit
                          </button>

                          <button 
                          type="button" 
                          class="btn btn-danger" 
                          data-toggle="modal" 
                          data-target="#modalKonf"
                          id="btnDelete{{$value->id}}"
                          data-idDelete = "{{$value->id}}">
                          hapus
                        </button> -->

                        <button class="btn btn-primary" data-toggle="tooltips" title="Edit"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" data-toggle="tooltips" title="Delete"><i class="fa fa-times"></i></button>

                      </div>
                    </div>


                  </td>
                </tr>
                @endforeach
              </tbody>
            </table></div></div></div>
          </div>

        </div>
      </div>
    </div>

  </div>
  @endsection
  <!-- plugin js -->
  @section('plugin_js')

  @endsection

  <!-- add js -->
  @section('add_js')
  <script>
    var btnAdd = document.getElementById('btnAdd');

    btnAdd.onclick = function() {
      modalAdd.style.display = "block";
      $('.select2').select2();
    }
  </script>
  @endsection