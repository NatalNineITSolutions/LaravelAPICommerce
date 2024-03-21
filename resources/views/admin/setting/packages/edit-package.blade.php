<div class="email-inbox__area">
    <div class="item-top mb-30 d-flex flex-wrap justify-content-between">
        <h2>{{ __('Add Package') }}</h2>
        <button type="button" class="border-0 btn-close pt-20" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <form class="ajax" action="{{ route('admin.setting.edit-package', ['id' => $package->id]) }}" method="POST"

        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ $package->name }}"
                                class="primary-form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Customer Limit') }} <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="customer_limit" value="{{ $package->customer_limit }}"
                                class="primary-form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Product Limit') }} <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="product_limit" value="{{ $package->product_limit }}"
                                class="primary-form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Subscription Limit') }} <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="subscription_limit" value="{{ $package->subscription_limit }}"
                                class="primary-form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="primary-form-group my-2">
                    <div class="primary-form-group-wrap">
                    <label class="form-label">{{ __('Monthly Price') }} <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="monthly_price" value="{{ $package->monthly_price }}"
                                class="primary-form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                        <label class="form-label">{{ __('Yearly Price') }} <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="yearly_price" value="{{ $package->yearly_price }}"
                                class="primary-form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="primary-form-group my-2">
                    <div class="primary-form-group-wrap">
                    <label class="form-label">{{ __('Success Url') }} <span
                                    class="text-danger">*</span></label>
                            <input type="url" name="success_link" value="{{ $package->success_link }}"
                                class="primary-form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="primary-form-group my-2">
                    <div class="primary-form-group-wrap">
                    <label class="form-label">{{ __('Cancel Url') }} <span
                                    class="text-danger">*</span></label>
                            <input type="url" name="cancel_link" value="{{ $package->cancel_link }}"
                                class="primary-form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                        <label for="toggle">Status</label>
                        <input type="checkbox" id="toggle" name="status" onchange="this.value = this.checked ? 1 : 0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                        <label for="toggle">Is Popular</label>
                        <input type="checkbox" id="toggle" name="is_default" onchange="this.value = this.checked ? 1 : 0">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                        <label for="toggle">Is Trial</label>
                        <input type="checkbox" id="toggle" name="is_trail" onchange="this.value = this.checked ? 1 : 0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 text-end">
                <button class="fs-15 fw-500 border-0 lh-25 text-white py-10 px-26 bg-7f56d9 bd-ra-12"
                    type="submit">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>



