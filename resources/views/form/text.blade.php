<div class="form__item" style="{{$field['style']}}">
    <div class="form__label">
        <label>
            {{$field['label']}}
        </label>
    </div>
    <div>
        <input class="inputfield" type="text" name="{{$field['name']}}"
               @isset ($model->{$field['name']}) value="{{ $model->{$field['name']} }}" @endisset
        >
    </div>
</div>
