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
                        {{-- <p class="card-description">
                                Basic form layout
                            </p> --}}
                        @include('admin.inc.error')
                        <form class="forms-sample" method="POST" action="{{ route('admin.type.house.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="slug">Thể loại nhà đất</label>
                                <input type="text" class="form-control" value="{{ old('title') }}" id="slug" name="title"
                                    placeholder="" onkeyup="changeToString()">
                            </div>
                            
                            
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Giá phòng</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="price"
                                    value="{{ old('price') }}" placeholder="* Giá phòng">
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="exampleTextarea1">Danh mục cấp 1</label>
                                <select class="js-example-basic-multiple w-100" name="category_lv1_id">
                                    <option value=""><-------Vui lòng chọn danh mục lv1-------></option>
                                    @foreach ($category_lv1 as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleTextarea1">Trạng thái</label>
                                <select class="js-example-basic-multiple w-100" name="status">
                                    <option value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{route('admin.type.house.index')}}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('script')

        <script>
        //     CKEDITOR.replace('description', {
        //     filebrowserBrowseUrl: '/public/ckfinder/ckfinder.html',
        //     filebrowserUploadUrl: '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        //     filebrowserWindowWidth: '1000',
        //     filebrowserWindowHeight: '700'
        // });
        </script>
    @endpush
