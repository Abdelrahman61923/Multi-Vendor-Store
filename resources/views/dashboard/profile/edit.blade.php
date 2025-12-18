@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
    <x-alert type="success" />
    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-row mb-3">
            <div class="col-md-6">
                <x-form.input label="First Name" name="first_name" :value="$user->profile->first_name" />
            </div>
            <div class="col-md-6">
                <x-form.input label="Last Name" name="last_name" :value="$user->profile->last_name" />
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="col-md-6">
                <x-form.input label="Birthday" name="birthday" type="date" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <x-form.radio label="Gender" name="gender" :checked="$user->profile->gender" :options="['male' => 'Male', 'female' => 'Female']" />
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="col-md-4">
                <x-form.input label="Street Address" name="street_address" :value="$user->profile->street_address" />
            </div>
            <div class="col-md-4">
                <x-form.input label="City" name="city" :value="$user->profile->city" />
            </div>
            <div class="col-md-4">
                <x-form.input label="State" name="state" :value="$user->profile->state" />
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="col-md-4">
                <x-form.input label="Postal Code" name="postal_code" :value="$user->profile->postal_code" />
            </div>
            <div class="col-md-4">
                <x-form.select label="Country" name="country" :options="$countries" :selected="$user->profile->country" />
            </div>
            <div class="col-md-4">
                <x-form.select label="Locale" name="locale" :options="$locales" :selected="$user->profile->locale" />
            </div>
        </div>
        <div class="form-group">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary mb-3">Store</button>
        </div>
    </form>
@endsection
