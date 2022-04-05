@extends('admin.layout')
@section('title', $row->title)
@section('content')
    <div class="content-wrapper">
        @include('admin.inc.message')
        <div class="card">
            <form>
                <div class="card-body">
                    <h4 class="card-title">{{ $row->desc }}</h4>
                    <a href="{{ route('admin.standard.add') }}" class="btn btn-info mb-3"><i class="fa fa-plus"></i>
                        Thêm</a>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>STT</th>
                                            <th>Photo</th>
                                            <th>Tiêu đề</th>
                                            <th>Mô tả</th>
                                            <th>Hiển thị</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="order_position">
                                        @if (isset($standard))
                                            @foreach ($standard as $item)
                                                <tr id="{{$item->id}}" title="Kéo thả chuột để sắp xếp">
                                                    <th><input type="checkbox" name="check[]" value="{{ $item->id }}" />
                                                    </th>
                                                    <td>{{ $item->stt }}</td>
                                                    <td><img src="{{asset('public/upload/images/standard/thumb/'.$item->photo)}}"
                                                            class="img-fluid" alt=""></td>
                                                    <td><a href="{{ route('admin.standard.edit', $item->id) }}" title="Chỉnh sửa { $item->title }}">{{ $item->title }}</a></td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>
                                                        <input type="checkbox" name="check_status[]"
                                                            {{ $item->status == 1 ? 'checked' : '' }}
                                                            id="check-status-{{ $item->id }}"
                                                            data-id-status="{{ $item->id }}">

                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                id="dropdownMenuIconButton6" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="mdi mdi-settings"></i>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuIconButton6"
                                                                x-placement="bottom-start"
                                                                style="position: absolute; transform: translate3d(0px, 46px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <h6 class="dropdown-header">Settings</h6>
                                                                <a class="dropdown-item" href="/" target="_blank" style="color: #5646ff"><i
                                                                        class="fa fa-eye"></i> View</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.standard.edit', $item->id) }}"
                                                                    style="color: rgb(197, 197, 16)"><i
                                                                        class="fa fa-pencil"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item" data-id="{{ $item->id }}"
                                                                    href="#" style="color: rgb(248, 21, 21)"
                                                                    data-name="{{ $item->title }}"><i
                                                                        class="fa fa-trash-o"></i>
                                                                    Delete</a>
                                                                {{-- <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Separated link</a> --}}
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="fe-trash-2"></i> <i
                                    class="fa fa-trash-o"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                <a class="dropdown-item" href="#"
                                    onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'check[]', true);return false;"><i
                                        class="fe-check-square"></i> Tất cả</a>
                                <a class="dropdown-item" href="#"
                                    onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'check[]', false);return false;"><i
                                        class="fe-x"></i> Hủy bỏ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" delete-all="true" url="/admin/news/delete-all"
                                    href="#"><i class="fe-trash-2"></i> Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(function() {
                $('.order_position').sortable({
                    placeholder: "ui-state-highlight",
                    update: function(event, ui) {
                        var array_id = [];
                        $('.order_position tr').each(function() {
                            array_id.push($(this).attr('id'));
                        });
                        //alert(array_id);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                            url: "{{ route('admin.standard.resorting') }}",
                            method: "POST",
                            data: {
                                array_id: array_id,
                            },
                            success: function(data) {
                                alert("Sắp xếp thành công");
                                location.reload();
                            }
                        });
                    }
                });
            });

            $("[data-id-status]").click(function() {
                var id_status = $(this).attr("data-id-status");
                var check = document.getElementById('check-status-' + id_status).checked;
                var _token = "{{ csrf_token() }}";
                if (check == true) {
                    $.ajax({
                        url: "/admin/tieu-chi/status/" + id_status + "/" + 1,
                        type: "GET",
                        data: {
                            id: id_status,
                            _token: _token
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                console.log(data.msg);
                            } else {
                                console.log(data.msg);
                            }
                        }
                    });
                } else {
                    $.ajax({
                        url: "/admin/tieu-chi/status/" + id_status + "/" + 0,
                        type: "GET",
                        data: {
                            id: id_status,
                            _token: _token
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                console.log(data.msg);
                            }
                        }
                    });
                }
            });

            $("[data-id]").click(function() {
                let id = $(this).attr("data-id");
                let name = $(this).attr("data-name");
                swal({
                        title: "Are you sure?",
                        text: "Bạn có chắc muốn xóa danh muc: " + name,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Xóa thành công phòng này", {
                                icon: "success",
                            });
                            $.ajax({
                                url: "/admin/tieu-chi/delete/" + id,
                                type: "GET",
                                data: {
                                    id: id
                                },
                                success: function(data) {
                                    if (data.status == 1) {

                                        window.location.reload();
                                    }
                                }
                            });
                        } else {
                            // swal("Bấm OK để trở lại");
                        }
                    });
            })
        })
    </script>
@endpush
