<x-front-layout title="two Factor Authentication">
    <!-- Start Breadcrumbs -->
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">two Factor Authentication</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li>two Factor Authentication</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>
    <!-- End Breadcrumbs -->

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('two-factor.enable') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>two Factor Authentication</h3>
                                <p>You can enable/disable 2FA.</p>
                            </div>
                            @if (session('status') == 'two-factor-authentication-confirmed')
                                <div class="mb-4 font-medium text-sm">
                                    Two factor authentication confirmed and enabled successfully.
                                </div>
                            @endif
                            <div class="button">
                                @if (!$user->two_factor_secret)
                                    <button class="btn" type="submit">Enable</button>
                                @else
                                <div class="d-flex justify-content-center p-4">
                                    {!! $user->twoFactorQrCodeSvg() !!}
                                </div>
                                <h3>Recovery Codes</h3>
                                <ul class="mb-3">
                                    @foreach ($user->recoveryCodes() as $code)
                                    <li>{{ $code }}</li>
                                    @endforeach
                                </ul>
                                    @method('delete')
                                    <button class="btn btn danger" type="submit">Disable</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->
</x-front-layout>
