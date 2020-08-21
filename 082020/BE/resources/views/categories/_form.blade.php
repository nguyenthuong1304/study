<form action="{{ isset($object) ? route('category.update', $object->id) : route('category.store') }}" method="post" id="form-category">
    @csrf
    @if(isset($object)) @method('put') @endif
    <div class="form-group">
        <div class="row">
            <div class="col-lg-7">
                <label>Tên danh mục</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control form-control-sm" 
                    placeholder="Tên danh mục"
                    value="{{ old('name') ?? $object->name ?? ''}}"
                >
            </div>
            <div class="col-lg-5">
                <label>Độ ưu tiên</label>
                <input 
                    type="text" 
                    name="priority" 
                    class="form-control form-control-sm" 
                    placeholder="0" 
                    value="{{ old('priority') ?? $object->priority ?? 0 }}"
                >
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Mô tả</label>
        <textarea 
            name="description" 
            class="form-control form-control-sm"
            value="{{ old('priority') ?? $object->description ?? ''}}"
        >{{ old('priority') ?? $object->description ?? ''}}</textarea>
    </div>
</form>