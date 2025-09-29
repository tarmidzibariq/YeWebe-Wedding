@extends('layouts.master')
@section('content')

<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Details</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">#{{ $order->id }}</dd>
                    <dt class="col-sm-3">Created At</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y H:i') }}</dd>
                    <dt class="col-sm-3">User</dt>
                    <dd class="col-sm-9">{{ $order->user?->name ?? 'N/A' }}</dd>
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
                    <dd class="col-sm-9">{{ $order->status }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

@endsection
