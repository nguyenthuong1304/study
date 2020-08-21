<form method="POST" action="{{ route('addHashTag', $user->id) }}" id="form-hashtag">
    @csrf
    <div class="row">
        <div class="col-md-2">
            Tags
        </div>
        <div class="col-md-10">
            <select class="js-example-basic-single form-control" name="tag_ids[]" multiple="multiple">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        const tags = {!! json_encode($user->tags) !!};
        $('.js-example-basic-single').select2({ width: '100%' })
            .val(tags.map(tag => tag.id ))
            .change();
    });
</script>