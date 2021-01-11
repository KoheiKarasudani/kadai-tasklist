@extends('layouts.app')

@section('content')
    
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
    {!! link_to_route('tasks.create','新規タスクの登録',[],['class' => 'btn btn-primary']) !!}
    
@endsection