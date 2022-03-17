<div class="form__item" style="{{$field['style']}}">
    <div class="form__label">
        <label>
            {{$field['label']}}
        </label>
    </div>
    <div class="form__widget timepicker_widget">
        <input class="timepicker" type="text" name="{{$field['name']}}"
               @isset ($model->{$field['name']}) value="{{ $model->{$field['name']} }}" @endisset
               autocomplete="off" readonly>
        <i class="far fa-clock"></i>
    </div>
</div>
