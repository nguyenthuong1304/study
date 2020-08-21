@extends('layouts.default')
@section('style')
    <link href="{{ asset('css/vender.css') }}" rel="stylesheet">
@endsection
@section('main')
@include('layouts.error')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Danh sách <button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-success">New</button></h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Độ ưu tiên</th>
                    <th>Người</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($categories as $category)
                      <tr>
                          <td id="name-{{$category->id}}">{{ $category->name }}</td>
                          <td id="description-{{$category->id}}">{{ $category->description }}</td>
                          <td id="priority-{{$category->id}}">{{ $category->priority }}</td>
                          <td>{{ $category->users_count }}</td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-sm btn-success edit" data-id="{{ $category->id }}" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-pen"></i>
                              </button>
                              <form action="{{ route('category.destroy', $category->id) }}" method="POSt">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger">
                                  <i class="fa fa-trash"></i>
                                </button>
                              </form>
                            </div>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
                <tr>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Độ ưu tiên</th>
                    <th>Người</th>
                    <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="title">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @include('categories._form')
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary submit">Save changes</button>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('script')
    <script src="{{ asset('js/vender.js') }}"></script>
    <script>
        $(function () {
          const formInit = $('#form-category');
          $('.edit').click(function (){
            const id = $(this).data('id');
            $.get(`category/${id}`)
              .then(e => {
                $('#form-category').replaceWith(e);
              });
          });

          $('.submit').click(() => {
            $.ajax({
              type: 'POST',
              url: $("#form-category").attr("action"),
              data: $("#form-category").serialize(), 
              success: function(response) {
                toastr.success("Success");
                if (response && $(`#name-${response.id}`).length) {
                  $(`#name-${response.id}`).html(response.name);
                  $(`#description-${response.id}`).html(response.description);
                  $(`#priority-${response.id}`).html(response.priority);
                }
                $('#exampleModal').modal('hide');
              },
            });
          })
        });
    </script>
@endsection