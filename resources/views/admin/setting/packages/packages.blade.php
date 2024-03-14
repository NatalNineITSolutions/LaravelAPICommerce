@extends('layouts.app')
@push('admin-style')
    <link rel="stylesheet" href="{{ asset('admin/styles/main.css') }}">
@endpush
@push('title')
    {{ $title }}
@endpush
@section('content')
    <div class="p-30">
        <div class="">
            <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{ __($title) }}</h4>
            <div class="row">
                <div class="col-12">
                    <div class="email-inbox__area bg-style form-horizontal__item bg-style admin-general-settings-page">
                        <input type="hidden" id="addpackage"
                            value="{{ route('admin.setting.add-package') }}">

                            <div class="row">
                                <div class="col-md-12 bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                                    <div style="text-align: right; padding-right: 10px; ">
                                        <button class="btn btn-primary mb-15" type="submit" onclick="configurepackage('0')"><i class="fas fa-plus"></i>Add Package</button>
                                    <div>
                                    <div class="table-responsive zTable-responsive">
                                        
                                        <table class="table zTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <div>{{ __('SL') }}<div>
                                                    </th>
                                                    
                                                    <th class="text-center">
                                                        <div>{{ __('Name') }}<div>
                                                    </th>
                                                    <th class="text-center">
                                                        <div>{{ __('Monthly Price') }}<div>
                                                    </th>
                                                    <th class="text-center">
                                                        <div>{{ __('Yearly Price') }}<div>
                                                    </th>
                                                    <th class="text-center">
                                                        <div>{{ __('Status') }}<div>
                                                    </th>
                                                    <th class="text-center">
                                                        <div>{{ __('Is Trial') }}<div>
                                                    </th>
                                                    <th class="text-center">
                                                        <div>{{ __('Action') }}<div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(getPackage() as $index => $package)
                                            <tr class="text-center">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $package->name }}</td>
                                                    <td>{{ $package->monthly_price }}</td>
                                                    <td>{{ $package->yearly_price }}</td>
                                                    <td>{{ $package->status }}</td>
                                                    <td>{{ $package->is_trail }}</td>

                                                    <td>
                                                        <div class="action__buttons ">
                                                            <button type="button"
                                                                class="btn btn-outline-none p-2 "
                                                                onclick="configurepackage('{{ $package->id }}')"><i class="fas fa-edit pr-2"></i>   
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-outline-none p-2 "
                                                                onclick="deletePackage('{{ $package->id }}')"><i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade main-modal" id="packageModal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content zModalTwo-content p-5">

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/js/configuration.js') }}"></script>
@endpush