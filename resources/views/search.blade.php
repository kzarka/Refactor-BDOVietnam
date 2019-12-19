@extends('layouts.main')

@section('title', 'Kết quả cho: ' . app('request')->input('q'))

@section('content')
<div class="index-main-wrapper">
    @php dd($results); @endphp
</div>
@endsection