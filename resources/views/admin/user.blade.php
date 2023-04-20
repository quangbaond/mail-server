@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- search user --}}
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.users.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nhập tên tài khoản" name="keyword" value="@if($keyword){{ $keyword }} @endif">
                        <select class="form-select" name="status">
                            <option value="1" @if($status == '1') selected @endif>Đang kích hoạt</option>
                            <option value="0" @if($status == '0') selected @endif>Hủy kích hoạt</option>
                        </select>
                        <button class="btn btn-outline-primary ml-1" type="submit" >Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Tên</th>
                <th scope="col">Tên tài khoản</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">hành Động</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status ? 'Đang kích hoạt' : 'Ngừng hoạt động' }}</td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('admin.users.active', $user->id) }}" method="post">
                                @method('PUT')
                                @csrf()
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary">
                                    @if($user->status)
                                        Hủy kích hoạt
                                    @else
                                        Kích hoạt
                                    @endif
                                </button>
                            </form>
                            <form action="{{ route('admin.users.delete', $user->id) }}" class="ml-2" method="POST">
                                @method('delete')
                                @csrf()
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-danger">Xóa
                                </a>
                            </form>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          {{ $users->withQueryString()->links() }}

    </div>
@endsection