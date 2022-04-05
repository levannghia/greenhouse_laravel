@extends('admin.layout')
@section('title', $row->title)
@section('content')

    <div class="content-wrapper">
        @include('admin.inc.message')
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $row->desc }}</h4>
                        @include('admin.inc.error')
                        <form class="forms-sample" method="POST"
                            action="{{ route('admin.type.house.update', $type->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="slug">Thể loại nhà đất</label>
                                <input type="text" class="form-control" value="{{ old('title', $type->title) }}"
                                    id="slug" name="title" placeholder="* Tên danh mục" onkeyup="changeToString()">
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleTextarea1">Danh mục cấp 1</label>
                                <select class="js-example-basic-multiple w-100" name="category_lv1_id">
                                    <option value="1"><-------Vui lòng chọn danh mục lv1-------></option>
                                    @foreach ($category_lv1 as $item)
                                    <option value="{{$item->id}}" {{$item->id == $category->category_lv1_id ? "selected" : ""}}>{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="form-group">
                                    <label for="price">Giá phòng</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        value="{{ old('price', $category->price) }}"
                                        placeholder="* Giá phòng">
                                </div> --}}
                            <div class="form-group">
                                <select class="js-example-basic-multiple w-100" name="status">
                                    <option value="1" {{ $type->status == 1 ? 'selected' : '' }}>Hiện</option>
                                    <option value="0" {{ $type->status == 0 ? 'selected' : '' }}>Ẩn</option>
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleTextarea1">Số thứ tự</label>
                                <input style="width: 11%;" type="text" class="form-control" name="stt"
                                    value="{{ old('stt', $category->stt) }}">
                            </div> --}}
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('admin.type.house.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <script>
            // CKEDITOR.replace('description', {
            //     filebrowserBrowseUrl: '/public/ckfinder/ckfinder.html',
            //     filebrowserUploadUrl: '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            //     filebrowserWindowWidth: '1000',
            //     filebrowserWindowHeight: '700'
            // });

            function changeToNumber() {
                var price;
                price = document.getElementById('price').value
                var convert = formatNumber(price);
                console.log(convert);
                document.getElementById('price').value = convert;
            }

            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
            }
        </script>
    @endpush
