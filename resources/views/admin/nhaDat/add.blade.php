@extends('admin.layout')
@section('title', $row->title)
@section('content')

    <div class="content-wrapper">
        @include('admin.inc.message')
        <form class="forms-sample" method="POST" action="{{ route('admin.nha.dat.store') }}"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $row->desc }}</h4>
                            @include('admin.inc.error')
                            @csrf
                            <div class="form-group">
                                <label for="slug">Tên dự án</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" id="slug" name="name"
                                    placeholder="* Tên sản phẩm" onkeyup="changeToString()">
                            </div>
                            <div class="form-group">
                                <label for="convert_slug">Slug (seo)</label>
                                <input type="text" class="form-control" id="convert_slug" name="slug"
                                    value="{{ old('slug') }}" placeholder="* slug">
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input type="text" class="form-control" value="{{ old('price') }}" id="price"
                                    name="price" placeholder="Giá sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="area">Diện tích</label>
                                <input type="text" class="form-control" value="{{ old('area') }}" id="area" name="area"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="area">Khu vực</label>
                                <select id="tinh_tp" class="js-example-basic-multiple w-100" name="city">                                 
                                    <option value="">
                                        Chọn tỉnh thành phố
                                    </option>
                                    @foreach ($tinhTP as $item)
                                        <option value="{{ $item->matp }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <select id="quanHuyen" class="js-example-basic-multiple w-100" name="district">                                 
                                    
                                    {{-- @foreach ($tinhTP as $item)
                                        <option value="{{ $item->matp }}">{{ $item->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Mô tả tóm tắt</label>
                                <textarea class="form-control" id="exampleTextarea1" rows="4" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Nội dung</label>
                                <textarea class="form-control" id="exampleTextarea1" rows="6" name="content">{{ old('content') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleTextarea1">Thể loại nhà đất</label>
                                
                                <select class="js-example-basic-multiple w-100" name="type_house_id">
                                    <option value="">
                                        Chọn thể loại
                                    </option>
                                    @foreach ($typeHouse as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Danh mục</label>
                                
                                <select class="js-example-basic-multiple w-100" name="category_id">
                                    
                                    <option value="">
                                        Chọn danh mục
                                    </option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Keywords (seo)</label>
                                <textarea class="form-control" id="exampleTextarea1" rows="4" name="keywords">{{ old('keywords') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Bản đồ</label>
                                <textarea class="form-control" id="exampleTextarea1" rows="4" name="map">{{ old('map') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Hiển thị</label>
                                <select class="js-example-basic-multiple w-100" name="status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php
                                $thumbsize = json_decode($settings['THUMB_SIZE_NHA_DAT']);
                                ?>
                                <label for="slug">Hình ảnh</label> <span>
                                    <p class="card-description">
                                        Upload (jpg, png, jpeg, gif)
                                        [{{ $thumbsize->width . 'px x ' . $thumbsize->height }}px]
                                    </p>
                                </span>
                                <input type="file" class="form-control" id="formFile" name="photo"
                                    onchange="previewFile(this);">
                                <img src="" class="form-control img-fluid" id="previewImage" class="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <a href="{{ route('admin.nha.dat.index') }}" class="btn btn-light">Cancel</a>
        </form>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function(){
            $('#tinh_tp').change(function() {
                var id = $(this).val();
                var _token = "{{ csrf_token() }}";
                var qh = $("#quanHuyen");
                $.ajax({
                    method: "GET",
                    url: "/quan-huyen",
                    data: {
                        maTp: id,
                        _token: _token
                    },
                    success: function(data) {
                        //console.log(data);
                        qh.html(data);
                    }
                });
            });
        });
        //hien thi anh truoc khi update
        function previewFile(input) {
            let file = $("#formFile").get(0).files[0];
            // console.log(file);
            if (file) {
                let reader = new FileReader();
                console.log(reader);
                reader.onload = function() {
                    $('#previewImage').attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
        CKEDITOR.replace('content', {
            filebrowserBrowseUrl: '/public/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        });
    </script>
@endpush
