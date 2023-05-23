<div class="heading-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 d-flex align-items-center">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="uploads/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                @if($global_top_ad_data->top_ad_status == 'Show')
                <div class="ad-section-1">
                    @if($global_top_ad_data->top_ad_url == '')
                        <img src="{{ asset('uploads/'.$global_top_ad_data->top_ad) }}" alt="">
                    @else
                        <a href="{{ $global_top_ad_data->top_ad_url }}"><img src="{{ asset('uploads/'.$global_top_ad_data->top_ad) }}" alt="" style="object-fit: cover"></a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
