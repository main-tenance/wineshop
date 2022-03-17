<div class="form__item" style="{{$field['style']}}">
    <div class="form__label">
        <label>
            {{$field['label']}}
        </label>
    </div>
    <div>
        <textarea name="{{$field['name']}}">
            @isset ($model->{$field['name']}) {{ $model->{$field['name']} }} @endisset
        </textarea>
    </div>
</div>
