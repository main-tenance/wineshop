<div class="form__item" style="{{$field['style']}}">
    <div class="form__label">
        <label>
            {{$field['label']}}
        </label>
    </div>
    <div class="form__widget datepicker_widget">
        <input class="datepicker narrow" type="date" name="{{$field['name']}}"
               @isset ($model->{$field['name']}) value="{{date('Y-m-d', strtotime($model->{$field['name']}))}}" @endisset
               autocomplete="off">
    </div>
</div>
