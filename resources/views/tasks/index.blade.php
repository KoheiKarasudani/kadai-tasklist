@extends('layouts.app')

@section('content')
@if(Auth::check()){{-- 認証済み --}}
    <?php $today = date('Y/m/d'); ?>
    <h1>本日({{$today}})のタスク一覧</h1>

    @if(count($tasks)>0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>項番</th>
                <th>    </th>
                <th>タスク</th>
                <th>締切</th>
                <th>進捗率(%)</th>
                <th>優先度</th>
                <th>ステータス</th>
                <th>    </th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{!! link_to_route('tasks.show',$task->id,['task' =>$task->id]) !!}</td>
                @if(strtotime($task->deadline) == strtotime(date('Ymd')))
                <td><i class="fas fa-fire"></i></td>
                @else(strtotime($task->deadline) == strtotime(date('Ymd',strtotime("+1 day"))))
                <td>    </td>
                @endif
                <td>{{$task->content}}</td>
                <td>{{$task->deadline}}</td>
                <td>{{$task->progress}}</td>
                <td>{{$task->priority}}</td>
                <td>{{$task->status}}</td>
                @if(strtotime($task->deadline) == strtotime(date('Ymd')))
                <td><i class="fas fa-hourglass-end"></i></td>
                @elseif(strtotime($task->deadline) == strtotime(date('Ymd',strtotime("+1 day"))))
                <td><i class="fas fa-hourglass-half"></i></td>
                @else
                <td><i class="fas fa-hourglass-start"></i></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    {{ $tasks ->links() }}
    {!! link_to_route('tasks.create','Create New Task',[],['class' => 'btn btn-primary']) !!}
@else{{-- 認証なし --}}
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Tasklists</h1>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endif
@endsection