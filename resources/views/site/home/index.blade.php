@php
use App\Http\Controllers\Helpers\captcha;

$format = new Captcha();
$logo = DB::table('photos')
    ->where('type', 'logo')
    ->first();
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';
$urlLogo = $protocol . $_SERVER['HTTP_HOST'] . '/public/upload/images/photo/thumb/' . $logo->photo;
@endphp
@extends('site.layout')
@section('SEO_title', $settings['SEO_TITLE'])
@section('SEO_keywords', $settings['SEO_KEYWORDS'])
@section('PHOTO', $urlLogo)
@if (isset($image->mimeType) && isset($image->width) && isset($image->height))
    @section('mimeType', $image->mimeType)
    @section('width', $image->width)
    @section('height', $image->height)
@endif
@section('SEO_description', $settings['SEO_DISCRIPTION'])
@section('content')
    <div class="content">

        <!-- Banner - menu -->
        {{-- silder --}}
        @include('site.inc.slide')
        <div class="container home-sell">
            <h1 class="title-center-home">Bất động sản hot</h1>
            <div class="boder-img">
                <img src="{{ asset('public/site/images/star.png') }}" alt="img">
            </div>
            <div class="row sell-box">
                @foreach ($nhaDatNB as $key => $item)
                    <div class="col col-md-4">
                        <div class="box-product">
                            <a href="/bds/{{ $item->slug }}">
                                <img class="card-img-top"
                                    src="{{ asset('public/upload/images/nhaDat/thumb/' . $item->photo) }}"
                                    alt="{{ $item->name }}">
                            </a>
                            <p class="home-title"><a href="/bds/{{ $item->slug }}">{{ $item->name }}</a>
                            </p>
                            <div class="box-price-bds">
                                <img style="width: 25px;height: 25px; margin-right: 10px; margin-top: -6px;"
                                    src="{{ asset('public/site/images/house-money.png') }}">
                                <span id="box-inner-price">{{ $format->jam_read_num_forvietnamese($item->price) }}</span>
                                <span>-&nbsp;{{ $item->area }}m<sup>2</sup></span>
                                <div class="date-post">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                                        xmlns="http://www.w3.org/2000/svg" class="clock-eight">
                                        <path
                                            d="M12,6a.99974.99974,0,0,0-1,1v4.38379L8.56934,12.60693a.99968.99968,0,1,0,.89843,1.78614l2.98145-1.5A.99874.99874,0,0,0,13,12V7A.99974.99974,0,0,0,12,6Zm0-4A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8.00917,8.00917,0,0,1,12,20Z" />
                                    </svg>
                                    {{ $item->created_at->format('d-m-Y') }}
                                </div>
                            </div>
                            <div class="box-time-bds" style="width: 100%; text-align: right; padding-top: 7px; ">
                                <span>{{ $item->title }}</span>
                            </div>
                            <div class="box-adress-bds"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="map">
                                        <path
                                            d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                                    </svg>
                                    {{ $item->tinh . ', ' . $item->quan }}</span></div>
                        </div>
                    </div>
                @endforeach


            </div>
            {{-- @if (count($nhaDatNB->get()) > 6) --}}
            <p class="read-more">
                <button class="next-xemthem" id="btn_read_more">Xem thêm
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="down">
                        <path
                            d="M169.4 278.6C175.6 284.9 183.8 288 192 288s16.38-3.125 22.62-9.375l160-160c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0L192 210.8L54.63 73.38c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L169.4 278.6zM329.4 265.4L192 402.8L54.63 265.4c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25l160 160C175.6 476.9 183.8 480 192 480s16.38-3.125 22.62-9.375l160-160c12.5-12.5 12.5-32.75 0-45.25S341.9 252.9 329.4 265.4z" />
                    </svg>
                </button>
            </p>
            {{-- @endif --}}
            
        </div>
        <div class="regional-estate">
            <h1 class="title-center-home">Bất động sản khu vực</h1>
            <div class="boder-img">
                <img src="{{ asset('public/site/images/star.png') }}" alt="img">
            </div>
            <div class="container">
                <div class="grid_duan">
                    @if (count($regionArray) <= 5)
                        @for ($i = 0; $i < count($regionArray); $i++)
                            @php
                                
                                $regionName = DB::table('tinhthanhpho')
                                    ->select('products.photo', 'tinhthanhpho.name', 'regions.slug')
                                    ->join('regions', 'regions.tp_id', '=', 'tinhthanhpho.matp')
                                    ->join('products', 'products.city', '=', 'tinhthanhpho.matp')
                                    ->where('tinhthanhpho.matp', $regionArray[$i])
                                    ->first();
                                $countRegion = DB::table('products')
                                    ->where('status', 1)
                                    ->where('city', $regionArray[$i])
                                    ->count();
                            @endphp
                            <div class="album_item">
                                <a href="/khu-vuc/{{ $regionName->slug }}"><img
                                        src="{{ asset('public/upload/images/nhaDat/thumb/' . $regionName->photo) }}"
                                        alt="{{ $regionName->name }}">
                                    <span>Bất động sản {{ $regionName->name }} <br>{{ $countRegion }} Tin </span>
                                </a>

                            </div>
                        @endfor
                    @endif

                </div>
            </div>
        </div>
        <div class="land-blocks">
            <div class="container">
                <marquee scrollamount="2">
                    @foreach ($nhaDat as $key => $item)
                        <a href=""><span>{{ $item->name }}</span></a>
                    @endforeach
                </marquee>
            </div>
        </div>
        <div class="project-block slide-block">
            <div class="container home-sell">
                <h1 class="title-center-home">Dự án nổi bật</h1>
                <div class="boder-img">
                    <img src="{{ asset('public/site/images/star.png') }}" alt="img">
                </div>
                <div class="row project-box">
                    <div class="owl-carousel owl-theme">
                        @foreach ($duAn as $key => $item)
                            <div class="box-project">
                                <a href="">
                                    <img class="card-img-top"
                                        src="{{ asset('public/upload/images/news/thumb/' . $item->photo) }}"
                                        alt="{{ $item->title }}">
                                </a>
                                <div class="box-price-bds">
                                    <div class="date-post">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                                            xmlns="http://www.w3.org/2000/svg" class="clock-eight">
                                            <path
                                                d="M12,6a.99974.99974,0,0,0-1,1v4.38379L8.56934,12.60693a.99968.99968,0,1,0,.89843,1.78614l2.98145-1.5A.99874.99874,0,0,0,13,12V7A.99974.99974,0,0,0,12,6Zm0-4A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8.00917,8.00917,0,0,1,12,20Z" />
                                        </svg>
                                        {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                    </div>
                                </div>
                                <p class="home-title"><a href="/du-an/{{ $item->slug }}">{{ $item->title }}</a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <p class="read-more">
                    <a class="next-xemthem" href="/chuyen-muc/thi-truong-bat-dong-san/">Xem thêm <i
                            class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </p>

            </div>
        </div>
        <div class="news-market-block slide-block">
            <div class="container">
                <p class="title-main">Tin thị trường <a class="next-xemthem-right" href="/tin-tuc">Xem thêm <i
                            class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>
                <div class="row">
                    <div class="owl-carousel owl-theme">
                        @foreach ($news as $key => $item)
                            <div class="box-project">
                                <a href="/tin-tuc/{{ $item->slug }}">
                                    <img class="card-img-top"
                                        src="{{ asset('public/upload/images/news/thumb/' . $item->photo) }}"
                                        alt="{{ $item->title }}">
                                </a>
                                <div class="box-price-bds">
                                    <div class="date-post">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                                            xmlns="http://www.w3.org/2000/svg" class="clock-eight">
                                            <path
                                                d="M12,6a.99974.99974,0,0,0-1,1v4.38379L8.56934,12.60693a.99968.99968,0,1,0,.89843,1.78614l2.98145-1.5A.99874.99874,0,0,0,13,12V7A.99974.99974,0,0,0,12,6Zm0-4A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8.00917,8.00917,0,0,1,12,20Z" />
                                        </svg>
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </div>
                                </div>
                                <p class="home-title"><a href="/tin-tuc/{{ $item->slug }}">{{ $item->title }}</a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="partner-blocks">
            <div class="container">
                <div class="row partner">
                    <div class="owl-carousel owl-theme">
                        @foreach ($partner as $key => $item)
                            <div class="item">
                                <div class="col-md-4 partner-option col-6 img-flucol-6">
                                    <a href="#"><img class="eeee"
                                            src="{{ asset('public/upload/images/photo/thumb/' . $item->photo) }}"
                                            alt="{{ $item->title }}"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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
            var page = 1;
            $('#btn_read_more').click(function() {
                var readMore = $('.sell-box');
                page = page + 1;
                $.ajax({
                    url: "{{ route('get.read.more') }}",
                    type: "GET",
                    data: {
                        page: page
                    },
                    success: function(data) {
                        var nextpage = page + 1;
                        $.ajax({
                            url: "{{ route('get.read.more') }}",
                            type: "GET",
                            data: {
                                page: nextpage
                            },
                            success: function(data) {
                                if(data.length == 0){
                                    $('#btn_read_more').hide();
                                }
                            }

                        });
                        readMore.append(data);
                    }
                });
            });

            $("#btn_send").click(function() {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data_form = $("#form_contact").serialize();
                var name = document.getElementById('ten');
                var mail = document.getElementById('email1');
                var content = document.getElementById('noidung');
                var phone = document.getElementById('dienthoai');


                $.ajax({
                    url: "{{ route('post.page.dang.ky') }}",
                    type: "POST",
                    data: "_token=" + _token + "&" + data_form,
                    beforeSend: function() {
                        $(".error_name").hide();
                        $(".error_phone").hide();
                        $(".error_email").hide();
                        $(".error_content").hide();
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.status == 1) {
                            swal("Sucessfuly, Thank you!", "We're will contact soon!",
                                "success").then((value) => {
                                if (value) {
                                    name.value = "";
                                    mail.value = "";
                                    content.value = "";
                                    phone.value = "";
                                }
                                if (value == null) {
                                    name.value = "";
                                    mail.value = "";
                                    content.value = "";
                                    phone.value = "";
                                }
                            });
                        } else {
                            data.error.name != undefined ? $(".error_name").html(
                                data.error.name).show() : "";
                            data.error.email != undefined ? $(".error_email").html(data.error
                                .email).show() : "";

                            data.error.phone != undefined ? $(".error_sdt").html(data.error
                                .phone).show() : "";

                            data.error.content != undefined ? $(".error_content").html(data
                                .error
                                .content).show() : "";
                        }
                    },
                });
            })
            $('.video-clip-blocks .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });

            $('.partner-blocks .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 4
                    },
                    1000: {
                        items: 6
                    }
                }
            });
            $('.project-block .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });

            $('.news-market-block .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })

            $('.album-hinh-anh .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                dots: false,
                nav: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });

            $('.doitac-tintuc .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 4000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        </script>
    @endpush
