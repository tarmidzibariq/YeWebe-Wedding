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
                                <th>User</th>
                                <th>Package Catalogue</th>
                                <th>Wedding Data</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr class="text-capitalize">
                                <td>#{{$item->id}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i')}}</td>
                                <td>{{ $item->user?->name ?? 'N/A' }}</td>
                                <td>{{ $item->catalogue?->package_name ?? 'N/A' }}</td>
                                <td>{{\Carbon\Carbon::parse($item->wedding_date)->translatedFormat('d F Y')}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle
                                            @if($item->status == 'approved') btn-success
                                            @elseif($item->status == 'requested') btn-warning
                                            @else btn-secondary @endif
                                            " type="button" id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $item->status }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                                            @foreach(['approved', 'requested'] as $statusOption)
                                            <li>
                                                <a class="dropdown-item status-option" href="#"
                                                    data-id="{{ $item->id }}" data-status="{{ $statusOption }}">
                                                    {{ $statusOption }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.order.show', $item->id) }}"
                                        class="btn btn-sm btn-warning">Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal kosong untuk show, akan diisi konten AJAX -->

            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('.status-option').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var status = $(this).data('status');
        if (confirm('Apakah Anda yakin ingin mengubah status menjadi ' + status + '?')) {
            $.ajax({
                url: '/admin/order/' + id,
                type: 'PUT',
                data: {
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error updating status');
                }
            });
        }
    });
});
</script>
@endpush
@endsection
