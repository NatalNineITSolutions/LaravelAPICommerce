<div class="col-6">
    <div class="item-top mb-30 d-flex flex-wrap justify-content-between">
        <h2>{{ __('Add Package') }}</h2>
        
    </div>

    <form class="ajax" action="{{ route('admin.setting.settings_env.update') }}" method="POST"
        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @csrf

                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="MAIL_MAILER" value="{{ env('MAIL_MAILER') }}"
                                class="primary-form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Customer Limit') }} <span class="text-danger">*</span></label>
                            <select name="MAIL_ENCRYPTION" class="primary-form-control sf-select-edit-modal">
                                <option value="tls" {{ env('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '' }}>
                                  {{ __('unlimite') }}
                                </option>
                                <option value="ssl" {{ env('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '' }}>
                                  {{ __('100') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Product Limit') }} <span class="text-danger">*</span></label>
                            <select name="MAIL_ENCRYPTION" class="primary-form-control sf-select-edit-modal">
                                <option value="tls" {{ env('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '' }}>
                                  {{ __('unlimite') }}
                                </option>
                                <option value="ssl" {{ env('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '' }}>
                                  {{ __('100') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Subscription Limit') }} <span class="text-danger">*</span></label>
                            <select name="MAIL_ENCRYPTION" class="primary-form-control sf-select-edit-modal">
                                <option value="tls" {{ env('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '' }}>
                                  {{ __('unlimite') }}
                                </option>
                                <option value="ssl" {{ env('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '' }}>
                                  {{ __('100') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Monthly Price') }} <span
                                    class="text-danger">*</span></label>
                            <input type="password" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}"
                                class="primary-form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('Yearly Price') }} <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}"
                                class="primary-form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group text-black">
                    <div class="primary-form-group mt-2">
                        <div class="primary-form-group-wrap">
                            <label class="form-label">{{ __('MAIL FROM NAME') }} <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}"
                                class="primary-form-control">
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