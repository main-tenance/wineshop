<div class="form__item" style="{{$field['style']}}">
    <div class="form__label">
        <label for="">{{$field['label']}}</label>
    </div>
    <div class="form__widget">
        <select name="{{$field['name']}}">
            @foreach ($field['values'] as $val)
                <option value="{{$val['id']}}"
                        @if (isset($model->{$field['name']}) && $val['id'] == $model->{$field['name']}) selected @endif
                >
                    {{$val['name']}}
                </option>
            @endforeach
        </select>
    </div>
</div>
