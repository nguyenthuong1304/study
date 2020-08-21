
<form id="form-profile" action="{{ route('update-user', $user->id) }}" method="POST" class="row" enctype="multipart/form-data">
  @csrf
  <div class="col-md-6 col-lg-6 col-xs-12">
      <h4 class="text-center">Thông tin cơ bản</h4>
      <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') ?? $user->email ?? '' }}">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Số điện thoại</label>
              <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="{{ old('phone') ?? $user->phone ?? '' }}">
            </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-6">
                <label>Họ</label>
                <input type="text" name="first_name" class="form-control" placeholder="Họ" value="{{ old('first_name') ?? $user->first_name ?? '' }}">
              </div>
              <div class="form-group col-md-6">
                <label>Tên</label>
                <input type="text" name="last_name" class="form-control" placeholder="Tên" value="{{ old('last_name') ?? $user->last_name ?? '' }}">
              </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-6">
                <label>Vai trò</label>
                <select class="form-control" name="role_id" value="{{ $user->role ?? '' }}">
                  <option value="">Chọn vài trò</option>
                  @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? "selected" : ''}}>{{ $role->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Loại</label>
                <select class="form-control" name="category_id" value="{{ $user->category_id ?? '' }}">
                  <option value="">Chọn danh mục</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $user->category_id == $category->id ? "selected" : ''}}>{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-12">
                  <label class="font-weight-bold">#hashtag :</label>
                  {{ implode(' ,', $user->tags->map(fn($tag) => $tag->title)->toArray()) }}
              </div>
          </div>
  </div>
  <div class="col-md-6 col-lg-6 col-xs-12">
      <h4 class="text-center">Thông tin hấp dẫn</h4>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Nickname</label>
            <input type="text" name="nickname" class="form-control" placeholder="Nickname" value="{{ old('nickname') ?? $user->information->nickname ?? '' }}">
          </div>
          <div class="form-group col-md-4">
            <label>Price</label>
            <input type="number" name="price" class="form-control" placeholder="Price" value="{{ old('price') ?? $user->information->price ?? '' }}">
          </div>
          <div class="col-auto my-1">
            <label>Price</label>
            <div class="custom-control custom-checkbox mr-sm-2">
              <input type="checkbox" name="hidden_price" @if($user->information->hidden_price == 1) checked @endif class="custom-control-input" id="customControlAutosizing" value="1">
              <label class="custom-control-label" for="customControlAutosizing">Ẩn</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" name="address" class="form-control" placeholder="1234 Main St" value="{{ old('address') ?? $user->information->address ?? '' }}">
        </div>
        <div class="form-group">
          <label>Bio</label>
          <textarea type="text" name="bio" class="form-control" placeholder="Giới thiệu">{{ old('bio') ?? $user->information->bio ?? '' }}</textarea>
        </div>
        <div class="form-group">
          <label>Mạng xã hội</label>
          @foreach (config('settings.socials') as $key => $social)
            <div class="form-group row">
              <button type="button" class="btn btn-outline-dark btn-circle btn-sm col-form-label">
                <i class="fab fa-{{$key}}"></i>
              </button>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" name="socials[{{$social}}]" placeholder="{{ ucfirst($key) }}" value="{{ $user->information->socials[$social] ?? ''}}">
              </div>
            </div>
          @endforeach
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="avatar" id="validatedCustomFile" required>
          <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
          <div class="invalid-feedback">Example invalid custom file feedback</div>
        </div>
  </div>
</form>