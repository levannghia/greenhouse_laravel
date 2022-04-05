@php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';
$urlPhoto = $protocol . $_SERVER['HTTP_HOST'] . '/public/upload/images/nhaDat/thumb/' . $nhaDat->photo;
@endphp
@extends('site.layout')
@section('PHOTO', $urlPhoto)
@section('SEO_title', $nhaDat->name)
@section('SEO_keywords', $nhaDat->keywords)
@section('mimeType', 'image/jpeg')
@section('width', 960)
@section('height', 720)
@section('SEO_description', substr($nhaDat->description, 0, 180))
@section('content')
    <div class="container">
        <div class="card-detail">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="preview col-md-9">
                                <div class="preview-pic tab-content">
                                    <div class="tab-pane active" id="pic-1"><img
                                            src="{{ asset('public/upload/images/nhaDat/thumb/' . $nhaDat->photo) }}"
                                            alt="{{ $nhaDat->name }}">
                                    </div>
                                    @php
                                        $i = 2;
                                    @endphp
                                    @foreach ($gallery as $item)
                                        <div class="tab-pane" id="pic-{{ $i++ }}"><img
                                                src="{{ asset('/public/upload/images/gallery/thumb/' . $item->photo) }}"
                                                alt="{{ $nhaDat->name }}">
                                        </div>
                                    @endforeach

                                </div>
                                <ul class="preview-thumbnail nav nav-tabs">
                                    @php
                                        $y = 2;
                                    @endphp
                                    @foreach ($gallery as $item)
                                        <li><a data-target="#pic-{{ $y++ }}" data-toggle="tab"><img
                                                    src="{{ asset('/public/upload/images/gallery/thumb/' . $item->photo) }}"
                                                    alt="{{ $nhaDat->name }}"></a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="col-md-3 info-detail">
                                <table class="table-att-info-bds" style="width:100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        class="detail-icon">
                                                        <path
                                                            d="M512 80C512 98.01 497.7 114.6 473.6 128C444.5 144.1 401.2 155.5 351.3 158.9C347.7 157.2 343.9 155.5 340.1 153.9C300.6 137.4 248.2 128 192 128C183.7 128 175.6 128.2 167.5 128.6L166.4 128C142.3 114.6 128 98.01 128 80C128 35.82 213.1 0 320 0C426 0 512 35.82 512 80V80zM160.7 161.1C170.9 160.4 181.3 160 192 160C254.2 160 309.4 172.3 344.5 191.4C369.3 204.9 384 221.7 384 240C384 243.1 383.3 247.9 381.9 251.7C377.3 264.9 364.1 277 346.9 287.3C346.9 287.3 346.9 287.3 346.9 287.3C346.8 287.3 346.6 287.4 346.5 287.5L346.5 287.5C346.2 287.7 345.9 287.8 345.6 288C310.6 307.4 254.8 320 192 320C132.4 320 79.06 308.7 43.84 290.9C41.97 289.9 40.15 288.1 38.39 288C14.28 274.6 0 258 0 240C0 205.2 53.43 175.5 128 164.6C138.5 163 149.4 161.8 160.7 161.1L160.7 161.1zM391.9 186.6C420.2 182.2 446.1 175.2 468.1 166.1C484.4 159.3 499.5 150.9 512 140.6V176C512 195.3 495.5 213.1 468.2 226.9C453.5 234.3 435.8 240.5 415.8 245.3C415.9 243.6 416 241.8 416 240C416 218.1 405.4 200.1 391.9 186.6V186.6zM384 336C384 354 369.7 370.6 345.6 384C343.8 384.1 342 385.9 340.2 386.9C304.9 404.7 251.6 416 192 416C129.2 416 73.42 403.4 38.39 384C14.28 370.6 .0003 354 .0003 336V300.6C12.45 310.9 27.62 319.3 43.93 326.1C83.44 342.6 135.8 352 192 352C248.2 352 300.6 342.6 340.1 326.1C347.9 322.9 355.4 319.2 362.5 315.2C368.6 311.8 374.3 308 379.7 304C381.2 302.9 382.6 301.7 384 300.6L384 336zM416 278.1C434.1 273.1 452.5 268.6 468.1 262.1C484.4 255.3 499.5 246.9 512 236.6V272C512 282.5 507 293 497.1 302.9C480.8 319.2 452.1 332.6 415.8 341.3C415.9 339.6 416 337.8 416 336V278.1zM192 448C248.2 448 300.6 438.6 340.1 422.1C356.4 415.3 371.5 406.9 384 396.6V432C384 476.2 298 512 192 512C85.96 512 .0003 476.2 .0003 432V396.6C12.45 406.9 27.62 415.3 43.93 422.1C83.44 438.6 135.8 448 192 448z" />
                                                    </svg>
                                                    Giá: </span> <span><span class="color-red"
                                                        id="inner-price">{{ $nhaDat->price }} VNĐ</span></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                        class="detail-icon">
                                                        <path
                                                            d="M416 32C433.7 32 448 46.33 448 64V128C448 145.7 433.7 160 416 160V352C433.7 352 448 366.3 448 384V448C448 465.7 433.7 480 416 480H352C334.3 480 320 465.7 320 448H128C128 465.7 113.7 480 96 480H32C14.33 480 0 465.7 0 448V384C0 366.3 14.33 352 32 352V160C14.33 160 0 145.7 0 128V64C0 46.33 14.33 32 32 32H96C113.7 32 128 46.33 128 64H320C320 46.33 334.3 32 352 32H416zM368 80V112H400V80H368zM96 160V352C113.7 352 128 366.3 128 384H320C320 366.3 334.3 352 352 352V160C334.3 160 320 145.7 320 128H128C128 145.7 113.7 160 96 160zM48 400V432H80V400H48zM400 432V400H368V432H400zM80 112V80H48V112H80z" />
                                                    </svg>
                                                    Diện tích: </span><span>{{ $nhaDat->area }}
                                                    m²</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                                        class="detail-icon">
                                                        <path
                                                            d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                                                    </svg>
                                                    Địa chỉ: </span><span> {{ $nhaDat->address }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                        class="detail-icon">
                                                        <path
                                                            d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z" />
                                                    </svg>
                                                    Loại hình: </span><span>Căn
                                                    hộ</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                                        class="detail-icon">
                                                        <path
                                                            d="M384 48V512l-192-112L0 512V48C0 21.5 21.5 0 48 0h288C362.5 0 384 21.5 384 48z" />
                                                    </svg>
                                                    Pháp lý: </span><span>sổ hồng</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        class="detail-icon">
                                                        <path
                                                            d="M256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512zM232 256C232 264 236 271.5 242.7 275.1L338.7 339.1C349.7 347.3 364.6 344.3 371.1 333.3C379.3 322.3 376.3 307.4 365.3 300L280 243.2V120C280 106.7 269.3 96 255.1 96C242.7 96 231.1 106.7 231.1 120L232 256z" />
                                                    </svg>
                                                    Ngày đăng:
                                                </span><span>{{ Carbon\Carbon::parse($nhaDat->created_at)->toDateString() }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="box-ngban">
                                    <div class="image-author"><img src="{{ asset('public/site/images/avt-ceo.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="ngban">Liên hệ: <span>Khúc Văn Trúc</span></div>
                                    <div class="btn-lienhe"><a
                                            href="tel:{{ $settings['PHONE'] }}">{{ $settings['PHONE'] }}</a></div>
                                </div>
                                <div class="repost">
                                    <div class="share-post"> <b>Trao đổi ngay:</b></div> <a target="_blank" href=""
                                        style="margin-left:10px;"><span
                                            class="a2a_svg a2a_s__default a2a_s_facebook_messenger"
                                            style="background-color: rgb(0, 132, 255); width: 30px; line-height: 30px; height: 30px; background-size: 30px; border-radius: 4px;"><svg
                                                focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 32 32">
                                                <path fill="#FFF"
                                                    d="M16 5C9.986 5 5.11 9.56 5.11 15.182c0 3.2 1.58 6.054 4.046 7.92V27l3.716-2.06c.99.276 2.04.425 3.128.425 6.014 0 10.89-4.56 10.89-10.183S22.013 5 16 5zm1.147 13.655L14.33 15.73l-5.423 3 5.946-6.31 2.816 2.925 5.42-3-5.946 6.31z">
                                                </path>
                                            </svg></span></a> <a target="_blank"
                                        href="https://zalo.me/{{ $settings['PHONE'] }}"><img
                                            style=" width: 30px; margin-left: 10px;"
                                            src="{{ asset('public/site/images/zalo-co.png') }}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="content-detail">
                            <h3 class="product-title">{{ $nhaDat->name }}</h3>
                            {{-- <div class="rating">
                                <div class="share">
                                    <div class="fb-like" data-href="{{ URL::current() }}" data-width=""
                                        data-layout="button_count" data-action="like" data-size="small" data-share="true">
                                    </div>
                                    <div class="zalo-share-button" data-href="" data-oaid="579745863508352884"
                                        data-layout="1" data-color="blue" data-customize="false"></div>
                                </div>
                            </div> --}}
                            <div class="box-price-area">
                                <div class="box-item"> <span class="title">Mức giá</span> <span
                                        class="value" id="inner-price2">{{ number_format($nhaDat->price, 0, ',', '.') }} VNĐ</span></div>
                                <div class="box-item"> <span class="title">Diện tích</span> <span
                                        class="value">299 m²</span>
                                </div>
                            </div>
                            <div class="thong_tin">
                                <span class="btnXDT tablinks7 hien" onclick="chemistrys(event, 'chitiet-0')">Thông tin
                                    chi tiết
                                </span>
                                <span class="btnTCD tablinks7" style="padding-left: 10px;" onclick="chemistrys(event, 'chitiet-1')">Bình luận
                                </span>
                            </div>
                            <br>
                            <div id="chitiet-0" class="content0">
                                {!! $nhaDat->content !!}
                            </div>
                            <div id="chitiet-1" class="content0">
                                <div class="fb-comments" data-href="{{ URL::current() }}" data-width="100%" data-numposts="5"></div>
                            </div>
                        </div>
                    </div>
                    <div class="details col-md-3">
                        <div class="contact-form-detail">
                            <h6>Đăng ký xem nhà</h6>
                            <form class="form-contact validation-contact" id="form_contact">
                                <input type="hidden" name="_token" value="2VmySV8hoxXTqpNC74anIagIAPqECQmmae9WgfB3">
                                <div class="row">
                                    <div class="input-contact col-sm-12">
                                        <input type="text" class="form-control" id="ten" name="name" value=""
                                            placeholder="Họ tên*" required="">
                                        <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                                        <p class="error_name mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                                    </div>
                                    <div class="input-contact col-sm-12">
                                        <input type="number" class="form-control" id="dienthoai" name="phone"
                                            placeholder="Số điện thoại*" required="" value="">
                                        <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
                                        <p class="error_sdt mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-contact col-sm-12">
                                        <input type="email" value="" class="form-control" id="email1" name="email"
                                            placeholder="Email*" required="">
                                        <div class="invalid-feedback">Vui lòng nhập địa chỉ email</div>
                                        <p class="error_email mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                                    </div>
                                </div>
                                <div class="input-contact">
                                    <textarea rows="4" class="form-control-te" id="noidung" name="content" placeholder="Nội dung" required=""></textarea>
                                    <div class="invalid-feedback">Vui lòng nhập nội dung</div>
                                    <p class="error_content mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                                </div>
                                <div class="captcha" style="display: flex;">
                                    <div class="input-contact" style="padding-right: 10px">
                                        <input type="text" class="form-control" id="captcha" value="" name="captcha"
                                            placeholder="Captcha*" required="">
                                        <p class="error_captcha mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                                    </div>
                                    <div class="img-captcha">
                                        <img width="140" height="34" id="captcha_ne" src="/captcha" alt="Captcha"
                                            title="Captcha">
                                    </div>
                                    <div class="reset-captcha" style="padding-top: 5px; padding-left: 5px">
                                        <img src="http://greenhouse.local/public/site/images/refresh.png"
                                            alt="refresh captcha" title="Refresh captcha">
                                    </div>
                                </div>
                                <input type="button" class="btn btn-success" name="submit-contact" id="btn_send"
                                    value="Đăng ký">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- <div class="share">
            <div class="fb-like" data-href="{{ URL::current() }}" data-width=""
                data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
            <div class="zalo-share-button" data-href="" data-oaid="579745863508352884" data-layout="1"
                data-color="blue" data-customize="false"></div>
        </div> --}}
    </div>
@endsection
@push('script_site')
    <script>
        $('.btnXDT').click(function() {
            $(this).addClass("hien")
            $('.btnTCD').removeClass("hien");
        })

        $('.btnTCD').click(function() {
            $(this).addClass("hien")
            $('.btnXDT').removeClass("hien");
        })

        function chemistrys(evt, cityName) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("content0");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks7");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
@endpush
