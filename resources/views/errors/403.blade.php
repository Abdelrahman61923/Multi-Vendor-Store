@extends('errors.home')

@section('content')
    <div class="error-area">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="error-content">
                        <h1>403</h1>
                        <h2>Oops! Access Denied!</h2>
                        <p>
                            You don’t have permission to access this page.
                            If you believe this is a mistake, please contact the administrator.
                        </p>
                        <div class="button">
                            <a href="{{ route('home') }}" class="btn">Back to Home</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
