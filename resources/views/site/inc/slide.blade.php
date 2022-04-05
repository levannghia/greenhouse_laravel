
<div class="row row-slide">
    <div class="col-md-12 row-right">
        {{-- <div class="slide-content">
            <h1>Bảo vệ chuyên nghiệp</h1>
            <h4>Đáp ứng nhu cầu mọi khách hàng</h4>
            <a href="{{ route('get.service') }}" class="read-more">Xem thêm</a>
        </div> --}}
        <div class="owl-carousel owl-theme">
            @foreach ($slider as $key => $item)
                <div class="item">
                    <img src="{{ asset('public/upload/images/photo/thumb/' . $item->photo) }}" class="d-block" alt="...">
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('script_site')
    <script>
        $('.row-right .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots:false,
            // animateOut: 'slideOutDown',
            animateOut: 'fadeOut',
            // animateIn: 'flipInX',
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    </script>
@endpush