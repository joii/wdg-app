@if($banner)
<div class="section section-banner">
    <div class="container">
        <a href="#" target="_blank">
            <img src="{{  asset($banner->image_path) }}" alt="{{ $banner->alt }}">
        </a>
    </div>
</div>
@endif
