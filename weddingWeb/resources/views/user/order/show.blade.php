@extends('layouts.master')
@section('content')

<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Details</h3>
                <div class="card-tools">
                    <a href="{{ route('user.order.index') }}" class="btn btn-sm btn-secondary">Back</a>
                </div>
            </div>
            <!-- Modal Zoom -->
            <div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content bg-transparent border-0">
                        <div class="modal-body text-center p-0">
                            <img id="zoomImage" src="{{  $order->catalogue->image && Storage::disk('public')->exists('catalogue/' . $order->catalogue->image)
                            ? asset('storage/catalogue/' . $order->catalogue->image)
                            : asset('asset/NoImage.png') }}" alt="{{$order->catalogue->package_name}} yewebe wedding" class="img-fluid w-100"
                                alt="Zoom Preview">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($order->catalogue && $order->catalogue->image)
                <div class="row mb-3">
                    <div class="col-4">
                        <img id="mainImage" src="{{  $order->catalogue->image && Storage::disk('public')->exists('catalogue/' . $order->catalogue->image)
                            ? asset('storage/catalogue/' . $order->catalogue->image)
                            : asset('asset/NoImage.png') }}" alt="Catalogue Image" class="img-fluid rounded w-50" data-bs-toggle="modal" data-bs-target="#zoomModal">
                    </div>
                </div>
                @endif
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">#{{ $order->id }}</dd>
                    <dt class="col-sm-3">Created At</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y H:i') }}</dd>
                    <dt class="col-sm-3">Package Catalogue</dt>
                    <dd class="col-sm-9">{{ $order->catalogue?->package_name ?? 'N/A' }}</dd>
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $order->name }}</dd>
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $order->email }}</dd>
                    <dt class="col-sm-3">Phone Number</dt>
                    <dd class="col-sm-9">{{ $order->phone_number }}</dd>
                    <dt class="col-sm-3">Wedding Date</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($order->wedding_date)->translatedFormat('d F Y') }}</dd>
                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        <span class="badge
                            @if($order->status == 'approved') bg-success
                            @elseif($order->status == 'requested') bg-warning
                            @else bg-secondary @endif">
                            {{ $order->status }}
                        </span>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function switchImage(el) {
            const main = document.getElementById("mainImage");
            const zoom = document.getElementById("zoomImage");

            // Set gambar utama
            main.src = el.src;

            // Set gambar zoom juga
            zoom.src = el.src;

            // Highlight aktif
            document.querySelectorAll(".thumb-img").forEach(img => img.classList.remove("active"));
            el.classList.add("active");
        }
</script>
    
@endpush
