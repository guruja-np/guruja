<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Sujan Timalsina">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Solve MCQs. Prepare for exams.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <!-- Page Title  -->
    <title>{{ env('APP_NAME') }}</title>
    <!-- StyleSheets  -->
    <!-- <link rel="stylesheet" href="{{-- asset('css/app.css') --}}"> -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('dashboard_assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('dashboard_assets/css/skins/theme-blue.css?ver=2.9.1') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
