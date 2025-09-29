<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">
                    @switch(true)
                        @case(request()->routeIs('admin.dashboard.index'))
                            Dashboard
                            @break
                        @case(request()->routeIs('admin.catalogue.*'))
                            Catalogue
                            @break
                        @case(request()->routeIs('admin.order.*'))
                            Order
                            @break
                        @case(request()->routeIs('admin.report.*'))
                            Report
                            @break

                        @default
                            halaman
                    @endswitch
                </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>

                    @switch(true)

                        {{-- admin.catalogue --}}
                        @case(request()->routeIs('admin.catalogue.index') )
                            <li class="breadcrumb-item active" aria-current="page">Catalogue</li>
                            @break
                        @case(request()->routeIs('admin.catalogue.create') )
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.catalogue.index')}}">Catalogue</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                            @break
                        @case(request()->routeIs('admin.catalogue.edit') )
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.catalogue.index')}}">Catalogue</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            @break
                        {{-- admin.order --}}
                        @case(request()->routeIs('admin.order.index') )
                            <li class="breadcrumb-item active" aria-current="page">Order</li>
                            @break
                        @case(request()->routeIs('admin.order.show') )
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.order.index')}}">Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                            @break
                        {{-- admin.report --}}
                        @case(request()->routeIs('admin.report.index') )
                            <li class="breadcrumb-item active" aria-current="page">Report</li>
                            @break
                        @default
                            <li class="breadcrumb-item active" aria-current="page">Halaman</li>
                    @endswitch   
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
