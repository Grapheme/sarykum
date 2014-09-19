
@if(isset($news) && is_object($news) && $news->count())

    <ul class="slide-terms clearfix">
        @foreach($news as $new)
        <?
        if (@!is_object($new->meta) || !$new->meta->title)
            continue;

        $photo = false;
        if (@is_object($new->meta->photo))
            $photo = $new->meta->photo->thumb();
        $gallery = false;
        if (@is_object($new->meta->gallery) && @is_object($new->meta->gallery->photos) && @count($new->meta->gallery->photos))
            $gallery = $new->meta->gallery->photos;
        ?>

        <li class="slide-term"><a href="#"></a>
            <div class="term-head"><a href="{{ URL::route('page', 'actions') }}">{{ $new->meta->title }}</a></div>
            <div class="term-body"><a href="{{ URL::route('page', 'actions') }}">{{ $new->meta->preview }}</a></div>
        </li>

        @endforeach
    </ul>

	{{-- $news->links() --}}

@endif
