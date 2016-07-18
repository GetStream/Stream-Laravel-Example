@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Current Tasks -->
        @if (count($activities) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    News Feed
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Time</th>
                            <th>User</th>
                            <th>Task</th>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ date('F j, Y, g:i a', strtotime($activity['time'])) }}</div>
                                    </td>
                                    <td class="table-text"><div>{{ $activity['display_name'] }}</div></td>
                                    <td class="table-text"><div>{{ $activity['name'] }}</div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@stop