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
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created At</th>
                                <th>Package Catalogue</th>
                                <th>Wedding Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr class="text-capitalize">
                                <td>#{{$item->id}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i')}}</td>
                                <td>{{ $item->catalogue?->package_name ?? 'N/A' }}</td>
                                <td>{{\Carbon\Carbon::parse($item->wedding_date)->translatedFormat('d F Y')}}</td>
                                <td>
                                    <span class="badge
                                        @if($item->status == 'approved') bg-success
                                        @elseif($item->status == 'requested') bg-warning
                                        @else bg-secondary @endif">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('user.order.show', $item->id) }}"
                                        class="btn btn-sm btn-warning">Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}

            </div>
        </div>
    </div>
</div>

@endsection
