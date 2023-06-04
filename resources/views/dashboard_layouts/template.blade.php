{{-- html header --}}
@include('dashboard_layouts/head')
{{-- html side menu bar --}}
@include('dashboard_layouts/nav')
{{-- view content dynamically added --}}
@yield('dashboard_layouts/content')
{{-- html footer --}}
@include('dashboard_layouts/footer')