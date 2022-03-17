<div class="form__item" style="{{$field['style']}}">
    <div class="form__label">
        <label>
            {{$field['label']}}
        </label>
    </div>
    <textarea name="{{$field['name']}}" class="editor">
        @isset ($model->{$field['name']}) value="{{ $model->{$field['name']} }}" @endisset
    </textarea>
</div>
