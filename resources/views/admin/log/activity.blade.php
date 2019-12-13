@extends('admin.layouts.main')

@section('title', 'Activity Log')

@section('content')
<div class="card">
    <div class="card-header"><i class="fa fa-align-justify"></i> Log</div>
    <div class="card-body">
        <table class="table table-responsive-sm table-hover table-outline mb-0">
            <thead class="thead-light">
                <tr>
                    <th width="20%">Date</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                <tr data-id="{{ $activity->id }}">
                    <td class="email">{{ $activity->created_at }}</td>
                    <td class="email">
                        <a href="{{ $activity->user->url_admin }}">{{ $activity->user->full_name }}</a> đã {{ $activity->verb }} <a href="{{ $activity->action_url }}">{{ $activity->action_name }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $activities->links('admin.partials.paginator') }}
    </div>
</div>
@endsection