<div class="breadcrumbs">
    @foreach($breadcrumbs as $breadcrumb)
        <div><a href="{{$breadcrumb['url']}}">{{$breadcrumb['caption']}}</a></div>
    @endforeach
</div>
