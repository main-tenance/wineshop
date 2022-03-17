<div class="offer-item-wrapper">
    <div class="offer-item-part">
        <div class="offer-item-year">{{ $offer->year }}</div>
        <div class="offer-item-volume">{{ $offer->volume }}&nbsp;л</div>
        <div class="offer-item-spirt">{{ $offer->spirt }}%</div>
        <div class="offer-item-name"><a href="{{\App\Http\Routes\Web\WebRoutesProvider::offerShow($offer)}}">{{stripslashes($offer->wine->name)}}</a></div>
    </div>
</div>
