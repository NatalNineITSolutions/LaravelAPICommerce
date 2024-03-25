@extends('admin.layouts.app')

@push('title')
    {{ $pageTitle }}
@endpush

@section('content')
    <!-- Page content area start -->
    <div class="px-24 pb-24 position-relative">
        <!-- Info & Add product button -->
        <div class="d-flex justify-content-between align-items-center g-10 flex-wrap pb-20">
            <div class="">
                <h4 class="fs-24 fw-500 lh-24 text-white"></h4>
            </div>
        </div>
        <!-- Table -->
        <div class="col-lg-12">
            <div class="col-md-12 bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <div class="customers__table">
                    <div class="table-responsive zTable-responsive">
                        <table class="able zTable" id="customersTable">
                            <thead>
                            <tr>
                                <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                    <div class="min-w-150">{{ __('Customer Name') }}</div>
                                </th>
                                <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                    <div class="min-sm-w-100">{{ __('Emails') }}</div>
                                </th>
                                <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                    <div class="min-w-120">{{ __('Created Date') }}</div>
                                </th>
                                <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                    <div class="min-sm-w-100">{{ __('Payments') }}</div>
                                </th>
                                <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                    <div class="min-sm-w-100">{{ __('Duration') }}</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Subscription::with('user')->get() as $subscription)
                                    <tr >
                                    <td>{{ optional($subscription->user)->name }}</td>
                                    <td>{{ optional($subscription->user)->email }}</td>
                                    <td>{{ $subscription->created_at }}</td>
                                        <td>
                                            @if ($subscription->status == 1)
                                                <div class="status-btn status-btn-green font-13 radius-4">
                                                    {{ __('Paid') }}</div>
                                            @else
                                                <div class="status-btn status-btn-orange font-13 radius-4">
                                                    {{ __('Pending') }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $subscription->duration }}</td>
                                    </tr>
                                @endforeach  
                            </tbody>         
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page content area end -->
@endsection
