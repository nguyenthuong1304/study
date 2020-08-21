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
                    <th>Tên danh mục (click đúp để sửa)</th>
                    <th>Người</th>
                    <th>Số lượt truy cập</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($tags as $tag)
                      <tr>
                          <td id="name-{{$tag->id}}">
                            <p class="name">
                                {{ $tag->title }}
                            </p>
                            <input type="text" class="form-control dp-n name" value="{{ $tag->title }}" data-id="{{ $tag->id }}">
                          </td>
                          <td>{{ $tag->users_count }}</td>
                          <td>{{ $tag->count }}</td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-sm btn-primary" data-id="{{ $tag->id }}">
                                <i class="fa fa-eye"></i>
                              </button>
                              <form action="{{ route('hashtag.destroy', $tag->id) }}" method="POSt">
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
                    <th>Người</th>
                    <th>Số lượt truy cập</th>
                    <th>Action</th>
                </tr>
              </tfoot>
            </table>
            {{ $tags->links() }}
          </div>
        </div>
      </div>
@endsection
@section('script')
    <script src="{{ asset('js/vender.js') }}"></script>
    <script>
        $(function () {
            $('td').dblclick(function () {
                $('input.name').addClass('dp-n');
                $('p.name').removeClass('dp-n');
                $(this).children('input').toggleClass('dp-n').focus()
                $(this).children('p').toggleClass('dp-n')
            });

            $('input.name').on('focusout', function () {
                handleTag($(this));
            });
        });

        const handleTag = (object) => {
            const id = object.data('id');
            const title = object.val().trim();
            $('input.name').addClass('dp-n');
            $('p.name').removeClass('dp-n');
            if (title === object.prev().html().trim()) return;
            $.ajax({
                url: `/hashtag/${id}`,
                method: 'PUT',
                data: {
                    title,
                },
                success: function (res) {
                    object.prev().html(title);
                    toastr.success("Lưu thành công")
                }
            })
        }
    </script>
@endsection