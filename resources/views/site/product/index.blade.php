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
            <h2 class="product-new">Bất động sản</h2>

            </p>
            <div class="row product-all">
                @foreach ($product as $key => $item)
                    <div class="col col-md-4">
                        <div class="box-product">
                            <a href="{{ route('get.product.slug', $item->slug) }}">
                                <img class="card-img-top" src="public/upload/images/product/thumb/{{ $item->photo }}"
                                    alt="{{ $item->name }}">
                            </a>
                            <p class="home-title"><a href="{{ route('get.product.slug', $item->slug) }}">{{ $item->name }}</a>
                            </p>
                            <div class="box-price-bds">
                                <img style="width: 25px;height: 25px; margin-right: 10px; margin-top: -6px;"
                                    src="{{ asset('public/site/images/house-money.png') }}">
                                @if ($item->price == null)
                                <span id="box-inner-price">Liên hệ</span>
                                @else
                                    <span id="box-inner-price">85 tỉ</span>
                                    <span>-&nbsp;805m<sup>2</sup></span>
                                @endif

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
                                    Thảo Điền, Quận 2</span></div>
                        </div>
                    </div>
                @endforeach
                {{-- @foreach ($product as $item)
                    <div class="col-md-3">
                        <div class="border-col">
                            <div class="detail-product-link">
                                <a href="{{ route('get.product.slug', $item->slug) }}"><img
                                        src="public/upload/images/product/thumb/{{ $item->photo }}" alt="" width="200px"></a>
                            </div>
                            <a href="{{ route('get.product.slug', $item->slug) }}">
                                <h6 class="product-name">{{ $item->name }}</h6>
                            </a>
                            <div class="price-view">
                                @if ($item->price == null)
                                    <p class="product-price">Giá: <a href="{{ $settings['PHONE'] }}"
                                            class="contact-product">Liên
                                            hệ</a> </p>
                                @else
                                    <p class="product-price">Giá: <a href="{{ route('get.product.slug', $item->slug) }}"
                                            class="contact-product">{{ number_format($item->price, 0, ',', '.') }} đ</a>
                                    </p>
                                @endif
                                <p class="product-views">Lượt xem: {{ $item->view }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
            </div>
            {{ $product->links() }}

        </div>
    </div>

@endsection
