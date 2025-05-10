@extends ('layout.header')

@section("title")
Urban Ride - Admin Dashboard
@endsection

@section('sidebar')
    <div class="flex flex-col space-y-6 mt-12"> <!-- Added margin-top to avoid overlapping the logo -->
        @include('layout.StaffManagementsidebar')
    </div>
@endsection
@section('Main')
    <h1 class="text-2xl font-bold text-gray-700">Accounts</h1>
@endsection
