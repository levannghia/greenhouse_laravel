@php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';
$urlPhoto = $protocol . $_SERVER['HTTP_HOST'] . '/public/upload/images/seoPage/thumb/' . $seoPage->photo;
@endphp
@section('PHOTO', $urlPhoto)
@extends('site.layout')
@section('SEO_title', $seoPage->title)
@section('SEO_keywords', $seoPage->keywords)
@if (isset($image->mimeType) && isset($image->width) && isset($image->height))
    @section('mimeType', $image->mimeType)
    @section('width', $image->width)
    @section('height', $image->height)
@endif
@section('SEO_description', $seoPage->description)
@section('content')
    <div class="content">
        <div class="container">
            <!-- Banner - menu -->

            {{-- silder --}}

            <!-- content -->
            <h2 class="product-new">BDS Xuyên Mộc</h2>

            </p>
            <div class="row">
                @foreach ($nhaDat as $item)
                    <div class="col col-md-4">
                        <div class="box-product">
                            <a href="/mua-ban-nha-dat/{{$item->slug}}">
                                <img class="card-img-top"
                                    src="{{ asset('public/upload/images/nhaDat/thumb/' . $item->photo) }}"
                                    alt="{{ $item->name }}">
                            </a>
                            <p class="home-title"><a href="/dich-vu/{{ $item->slug }}">{{ $item->name }}</a>
                            </p>
                            <div class="box-price-bds">
                                <img style="width: 25px;height: 25px; margin-right: 10px; margin-top: -6px;"
                                    src="{{ asset('public/site/images/house-money.png') }}">

                                @if ($item->price == null)
                                    <div class="acreage">
                                        <i class="bi bi-currency-dollar"></i>
                                        <p><a href="tel:{{ $settings['PHONE'] }}" style="color: red;" href="">Liên hệ</a>
                                        </p>
                                    </div>
                                @else
                                    <span id="box-inner-price">{{ number_format($item->price, 0, ',', '.') }}</span>
                                @endif
                                <span>-&nbsp;{{ $item->area }}m<sup>2</sup></span>
                                <div class="date-post">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                                        xmlns="http://www.w3.org/2000/svg" class="clock-eight">
                                        <path
                                            d="M12,6a.99974.99974,0,0,0-1,1v4.38379L8.56934,12.60693a.99968.99968,0,1,0,.89843,1.78614l2.98145-1.5A.99874.99874,0,0,0,13,12V7A.99974.99974,0,0,0,12,6Zm0-4A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8.00917,8.00917,0,0,1,12,20Z" />
                                    </svg>
                                    {{ $item->created_at }}
                                </div>
                            </div>
                            <div class="box-time-bds" style="width: 100%; text-align: right; padding-top: 7px; ">
                                <span>Biệt thự</span>
                            </div>
                            <div class="box-adress-bds"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="map">
                                        <path
                                            d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                                    </svg>
                                    {{$item->address}}</span></div>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 real-estate">
                    <div class="cover">
                        <div class="row">
                            <div class="col-md-6 cover-row">
                                <a href="/mua-ban-nha-dat/{{$item->slug}}"><p><img src="public/upload/images/nhaDat/thumb/{{ $item->photo }}" alt="" class="img-padding"></p></a>
                            </div>
                            <div class="col-md-6 content_tintuc">
                                <div class="cover-bottom cover-bottom-nhadat">
                                    <a href="/mua-ban-nha-dat/{{$item->slug}}"><h6>{{ $item->name }}</h6></a>
                                    <div class="info info_tintuc">
                                        
                                        @if ($item->price == null)
                                        <div class="acreage">
                                            <i class="bi bi-currency-dollar"></i>
                                            <p><a href="tel:{{ $settings['PHONE'] }}" style="color: red;" href="">Liên hệ</a></p>
                                        </div>
                                        @else
                                        <div class="acreage">
                                            <i class="bi bi-currency-dollar"></i>
                                            <p style="color: red;">{{ number_format($item->price, 0, ',', '.') }} đ</p>
                                        </div>
                                        @endif
                                        <p>Diện tích: <a style="color: blue;" href="">{{ $item->area }}m<sup>2</sup></a></p>
                                    </div>
                                    <div class="acreage acre-map">
                                        <i class="bi bi-geo-alt"></i> <span data-id="{{ $item->id }}">Xem bản đồ</span>
                                    </div>
                                    
                                    @if (strlen($item->description) >= 150)
                                    
                                    <p class="des">{{ substr($item->description, 0, 150) . ' [...]' }}</p>
                                    @else
                                    <p class="des">{{$item->description}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @endforeach
            </div>
            {{ $nhaDat->links() }}

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_map" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Bản đồ</h5>
                    <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_site')
    <script>
        $(document).ready(function() {

            $("[data-id]").click(function() {
                $('#modal_map').modal('show');
                let id = $(this).attr('data-id');
                let _token = $('meta[name="csrf-token"]').attr('content');
                $(document).on('click', '.modal-close', function() {
                    $('#my_modal').modal('hide');
                })
                $.ajax({
                    method: "POST",
                    url: "{{ route('show.map') }}",
                    data: {
                        _token: _token,
                        id: id
                    },
                    success: function(data) {
                        if (data.status) {
                            //console.log(data);
                            if (data.data.map != null) {
                                $('.modal-body').html(data.data.map);
                            } else {
                                $('.modal-body').html("Đang cập nhật");
                            }
                        } else {
                            $('.modal-body').html("Đang cập nhật");
                        }
                    }
                });
            });
        })
    </script>
@endpush
