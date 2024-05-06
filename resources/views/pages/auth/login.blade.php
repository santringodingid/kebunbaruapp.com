<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" method="post" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('home') }}" action="{{ route('login') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">
                Login, yuk!
            </h1>
            <!--end::Title-->

            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">
                Semoga harimu baik-baik aja
            </div>
            <!--end::Subtitle--->
        </div>
        <!--begin::Heading-->

        <!--begin::Login options-->
{{--        <div class="row g-3 mb-9">--}}
{{--            <!--begin::Col-->--}}
{{--            <div class="col-md-6">--}}
{{--                <!--begin::Google link--->--}}
{{--                <a href="{{ url('/auth/redirect/google') }}?redirect_uri={{ url()->current() }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">--}}
{{--                    <img alt="Logo" src="{{ image('svg/brand-logos/google-icon.svg') }}" class="h-15px me-3"/>--}}
{{--                    Login dengan Google--}}
{{--                </a>--}}
{{--                <!--end::Google link--->--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}

{{--            <!--begin::Col-->--}}
{{--            <div class="col-md-6">--}}
{{--                <!--begin::Google link--->--}}
{{--                <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">--}}
{{--                    <img alt="Logo" src="{{ image('svg/brand-logos/facebook-3.svg') }}" class="theme-light-show h-15px me-3"/>--}}
{{--                    <img alt="Logo" src="{{ image('svg/brand-logos/facebook-3-dark.svg') }}" class="theme-dark-show h-15px me-3"/>--}}
{{--                    Login dengan Facebook--}}
{{--                </a>--}}
{{--                <!--end::Google link--->--}}
{{--            </div>--}}
{{--            <!--end::Col-->--}}
{{--        </div>--}}
        <!--end::Login options-->

        <!--begin::Separator-->
{{--        <div class="separator separator-content my-14">--}}
{{--            <span class="w-125px text-gray-500 fw-semibold fs-7">Atau</span>--}}
{{--        </div>--}}
        <!--end::Separator-->

        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
            <!--end::Email-->
        </div>

        <!--end::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Password-->
            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
            <!--end::Password-->
        </div>
        <!--end::Input group--->


        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Login'])
            </button>
        </div>
        <!--end::Submit button-->

    </form>
    <!--end::Form-->

</x-auth-layout>
