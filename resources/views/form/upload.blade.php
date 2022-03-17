<div class="form__item" style="{{$field['style']}}">
    <div class="form__label">
        <label>
            {{$field['label']}}
        </label>
    </div>
    <div>
        <div id="upload-area">
            <div class="upload-prompting">Загрузите файл с помощью диалога выбора файлов или перетащив нужный файл в выделенную
                область</div>
            <input type="file" id="upload-file" data-upload_url="{{$field['upload_url']}}" multiple>
            <label class="btn" for="upload-file">Выбрать файл</label>
        </div>
        <input type="hidden" name="uploaded-file">
        <div id="uploaded-files"></div>
        <div id="upload-errors"></div>
    </div>
</div>
