@php
    $text = isset($register) ? 'Register' : 'Login';
@endphp
@if (@gs('socialite_credentials')->google->status == Status::ENABLE)
    <div class="mb-3 continue-google">
        <a href="{{ route('user.social.login', 'google') }}" class="btn w-100 social-login-btn">
            <span class="google-icon">
                <img src="{{ asset($activeTemplateTrue . 'images/google.svg') }}" alt="Google">
            </span> @lang("$text with Google")
        </a>
    </div>
@endif
@if (@gs('socialite_credentials')->facebook->status == Status::ENABLE)
    <div class="mb-3 continue-facebook">
        <a href="{{ route('user.social.login', 'facebook') }}" class="btn w-100 social-login-btn">
            <span class="facebook-icon">
                <img src="{{ asset($activeTemplateTrue . 'images/facebook.svg') }}" alt="Facebook">
            </span> @lang("$text with Facebook")
        </a>
    </div>
@endif
@if (@gs('socialite_credentials')->linkedin->status == Status::ENABLE)
    <div class="continue-facebook mb-3">
        <a href="{{ route('user.social.login', 'linkedin') }}" class="btn w-100 social-login-btn">
            <span class="facebook-icon">
                <img src="{{ asset($activeTemplateTrue . 'images/linkdin.svg') }}" alt="Linkedin">
            </span> @lang("$text with Linkedin")
        </a>
    </div>
@endif

@if (
    @gs('socialite_credentials')->linkedin->status ||
        @gs('socialite_credentials')->facebook->status == Status::ENABLE ||
        @gs('socialite_credentials')->google->status == Status::ENABLE)
    <div class="auth-devide">
        <span>OR</span>
    </div>
@endif
@push('style')
    <style>
        .social-login-btn {
            border: 1px solid #dddddd54 !important;
            color: #fff !important;
        }

        .social-login-btn:hover {
            border: 1px solid #dddddd54 !important;
            color: #f2f2f2;
        }

        .auth-devide {
            text-align: center;
            margin-block: 25px;
            position: relative;
            z-index: 1;
        }

        .auth-devide span {
            font-weight: 500;
            padding-inline: 6px;
            background-color: #001933;
            color: #fff;
        }

        .auth-devide::after {
            content: "";
            position: absolute;
            height: 1px;
            width: 100%;
            background-color: #dddddd54;
            top: 50%;
            left: 0;
            z-index: -1;
        }

        /* Autofill Css */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-transition: background-color 5000s ease-in-out 0s;
            transition: background-color 5000s ease-in-out 0s;
        }

        input:-webkit-autofill,
        textarea:-webkit-autofill,
        select:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px transparent inset;
            -webkit-text-fill-color: #fff !important;
            caret-color: #fff;
        }
    </style>
@endpush
