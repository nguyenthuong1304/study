@extends('layouts.default')
@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Role</th>
                  <th>Category</th>
                  <th>Tags</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Role</th>
                  <th>Category</th>
                  <th>Tags</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="modal fade" id="assign-tag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cập nhật tag</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="user_tag-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="submit-hashtag">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Chi tiết và cập nhật</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="user_profile-body">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="submit-profile">Lưu</button>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/vender.js') }}"></script>
    <script>
        $(document).ready(function() {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
            $('.js-example-basic-single').select2();
            $('#dataTable').DataTable({
              "processing": true,
              "paging": true,
              "serverSide": true,
              ajax: {
                  "url": location.href,
                  "dataType": "json",
                  "dataSrc": "data.data"
              },
              "columns": [
                  { data: 'full_name', render: function(data, fn, row) {
                    return data;
                  }},
                  { data: 'email' },
                  { data: 'phone' },
                  { data: 'role.name' },
                  { data: 'category.name', render: function(data) {
                    return data === undefined ? '...' : data;
                  }},
                  { data: 'tags', render: function (data) {
                    return data.map(e => e.title )
                  }},
                  { data: 'id', 
                    render: function (id) {
                      return `<button data-id="${id}" class="btn btn-sm btn-primary profile-user" data-toggle="modal" data-target="#modal-user">
                                <i class="fa fa-edit"></i>
                              </button>
                              <a href="/users/${id}" class="btn-sm btn btn-success">
                                <i class="fa fa-images"></i>
                              </a>
                              <a href="/users/${id}" class="delete btn-sm btn btn-danger">
                                <i class="fa fa-trash"></i>
                              </a>
                              <button class="btn-sm btn btn-warning assign-tag" data-id="${id}" data-toggle="modal" data-target="#assign-tag">
                                <i class="fa fa-star"></i>
                              </button>`
                      ;
                    }
                },
              ],
            });

            $('body').on('click', '.delete', function(e) {
              e.preventDefault();
              let href = $(this).attr('href');
              swal.fire({
                type: 'warning',
                text: 'Bạn chắc muốn xóa',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tôi đồng ý',
                icon: 'warning'
              }).then(e => {
                if (e.value) {
                  $.ajax({
                    url: href,
                    method: 'DELETE',
                    dataType: 'json',
                  }).then(e => swal.fire({
                    type: 'success',
                    icon: 'success',
                  }).then(e => location.reload()))
                }
              })
            });

            $('body').on('click', '.assign-tag', function() {
              const id = $(this).data('id');
              $.get(`/user_tag/${id}`)
              .then( e => {
                $('#user_tag-body').html(e);
              }).catch( e => {
                console.log(e);
              });
            });

            $('body').on('click', '.profile-user', function() {
              const id = $(this).data('id');
              $.get(`/users/${id}`)
              .then( e => {
                $('#user_profile-body').html(e);
              }).catch( e => {
                console.log(e);
              });
            });

            $('#submit-hashtag').click(() => {
              $.post($("#form-hashtag").attr('action'), $("#form-hashtag").serialize())
                .then( res => {
                  swal.fire({
                    type: 'success',
                    text: 'Thành công',
                    icon: 'success',
                  }).then( e => {
                    $('#assign-tag').modal('hide')
                  })
                })
                .catch(err => {
                  console.log(err)
                })
            })

            $('#submit-profile').click(() => {
              var formData = new FormData($("#form-profile")[0]);
              $.ajax({
                  url: $("#form-profile").attr('action'),
                  type: 'POST',
                  data: formData,
                  success: function (data) {
                    swal.fire({
                      type: 'success',
                      text: 'Thành công',
                      icon: 'success',
                    }).then( e => {
                      $('#modal-user').modal('hide')
                    })
                  },
                  cache: false,
                  contentType: false,
                  processData: false
              });
          });
        });
    </script>
@endsection