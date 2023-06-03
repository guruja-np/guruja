@extends('dashboard_layouts/template')

@section('dashboard_layouts/content')
    <h1>Admin Dashboard</h1>
    <div x-data={'hello':'world'}>
        <span x-text="'hello ' + hello"></span>
    </div>
@endsection
@section('dashboard_layouts/modal')
@endsection
@section('dashboard_layouts/script')
@endsection
