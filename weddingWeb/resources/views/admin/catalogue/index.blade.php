@extends('layouts.master')
@section('content')


<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">

        {{-- alert success --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{route('admin.catalogue.create')}}" class="btn btn-primary">Create</a>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Create At</th>
                                <th>Package Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catalogues as $item)
                            <tr>
                                <td>#{{$item->id}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i')}}</td>
                                <td>{{$item->package_name}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{'Rp '.number_format($item->price, 0, ',', '.')}}</td>
                                <td>{{$item->status_publish}}</td>
                                <td>
                                    {{-- Tombol untuk membuka modal detail mobil --}}
                                    <button type="button" class="btn btn-sm btn-info btn-show-detail"
                                        data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#catalogueModal">
                                        Show
                                    </button>
                                    {{-- Tombol edit --}}
                                    <a href="{{ route('admin.catalogue.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    {{-- Form untuk delete dengan konfirmasi --}}
                                    <form action="{{ route('admin.catalogue.destroy', $item->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-end">
                    {{ $catalogues->appends(request()->query())->links('pagination::bootstrap-5') }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
