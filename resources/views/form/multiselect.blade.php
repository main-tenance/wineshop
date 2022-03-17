<div class="form__item" style="{{$field['style']}}">
    <div class="form__label">
        <label>
            {{$field['label']}}
        </label>
    </div>
    <div class="form__widget">
        <select class="chosen-select" name="{{$field['name']}}[]" multiple>
            @foreach ($field['values'] as $val)
                <option value="{{$val['id']}}"
                        @if(isset($model->{$field['name']}) && ($model->{$field['name']}->pluck('id')->search($val['id']) !== false)) selected @endif
                >
                    {{$val['name']}}
                </option>
            @endforeach
        </select>
    </div>
</div>
