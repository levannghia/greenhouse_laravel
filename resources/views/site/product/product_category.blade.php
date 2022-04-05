@php
use App\Http\Controllers\Helpers\captcha;

$format = new Captcha();
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$urlPhoto = $protocol . $_SERVER['HTTP_HOST'] .'/public/upload/images/seoPage/thumb/'.$seoPage->photo;
@endphp
@section('PHOTO', $urlPhoto)
@extends('site.layout')
@section('SEO_title', $category_name->name)
@section('SEO_keywords', $category_name->keywords)
@if (isset($image->mimeType)  && isset($image->width) && isset($image->height))
@section('mimeType', $image->mimeType)
@section('width', $image->width)
@section('height', $image->height)
@endif
@section('SEO_description', $category_name->description)
@section('content')
    <div class="content">
        <div class="container home-sell">
            {{-- silder --}}

            @include('site.inc.breadcrumb', [
                'param1' => $category_name->name,
                'param2' => '',
                'param3' => ''
            ])
            <!-- content -->
    
            <div class="row sell-box">
                @foreach ($cate_pro as $key => $item)
                    <div class="col col-md-3">
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
            {{$cate_pro->links()}}
        </div>
    </div>

@endsection
