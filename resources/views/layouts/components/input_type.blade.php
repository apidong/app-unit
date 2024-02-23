@switch($type)
    @case('text')
        <input type="text" class="form-control" value="{{ $value }}" name="{{ $key }}" />
    @break

    @case('textarea')
        <textarea class="form-control" name="{{ $key }}">{{ $value }}</textarea>
    @break

    @default
        <input type="text" class="form-control" placeholder="type tidak terdapat di kategori" />
@endswitch
