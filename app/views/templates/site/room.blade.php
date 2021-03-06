@extends(Helper::layout())
<?
if (isset($room->seo) && is_object($room->seo))
    $seo = $room->seo;
?>


@section('style')
@stop


@section('content')

    @if (Input::get('dbg-room'))
    {{ Helper::tad($room) }}
    @endif

<?
$obj = $room;
#Helper::tad($obj);

$photo = false;
if (@is_numeric($obj->image)) {
    $photo = Photo::find($obj->image) ?: false;
}

$gallery = array();
if (@is_numeric($obj->gallery)) {
    $gallery = Gallery::where('id', $obj->gallery)->with('photos')->first() ?: array();
}
#Helper::tad($gallery);

#$photos = array($photo);
$photos = array();
if (@is_object($gallery) && @count($gallery->photos)) {
    foreach ($gallery->photos as $gphoto) {
        $photos[] = $gphoto;
    }
}
#Helper::dd($photos);
?>

    <main role="main">
        <div class="slideshow room-slideshow" id="slideshow">

            @if (@count($photos))
            @foreach ($photos as $photo)
            <div class="slide" style="background-image: url({{ $photo->full() }})">
                <section class="room-item">
                        <!-- <div class="room-name">
                            {{ $room->name }}
                        </div>
                        <div class="room-price">
                            {{ $room->prices }} {{ trans('interface.currency_short') }}
                        </div> -->
                </section>
            </div>
            @endforeach
            @endif

            <div class="arrow arrow-left"><span class="icon icon-angle-left"></span></div>
            <div class="arrow arrow-right"><span class="icon icon-angle-right"></span></div>
        </div>
        <section class="sect-wrap">
            <h1>
                {{ is_object($room->seo) && $room->seo->h1 ? $room->seo->h1 : $room->name }}
            </h1>

            @if ($room->prices)
            <h2 class="room-price room-prices">
                <span class="price-num">{{ $room->prices }}</span>
            </h2>
            @endif
            @if (0)
                @if ($room->price)
                <h2 class="room-price room-price-1">
                    <span class="price-num">{{ $room->price }}</span>
                    {{ trans("interface.rooms.single_occupancy") }}
                </h2>
                @endif
                @if ($room->price2)
                <h2 class="room-price room-price-2">
                    <span class="price-num">{{ $room->price2 }}</span>
                    {{ trans("interface.rooms.double_occupancy") }}
                </h2>
                @endif
            @endif

            <div class="row clearfix">
                <div class="column half">
                    <div class="row clearfix">
                        <div class="column">
                            {{ $room->description }}
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary reserve_room" data-room_id="{{ $room->id }}.1">
                <span class="icon icon-booking"></span> {{ trans('interface.menu.reserve') }}
            </button>
        </section>
    </main>

@stop


@section('scripts')
@stop