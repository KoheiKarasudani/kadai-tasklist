@extends('layouts.app')

@section('content')

    <h1>項番{{$task->id}}のタスク詳細ページ</h1>
    <table class="table table-borderd">
        <tr>
            <th>id</th>
            <td>{{$task->id}}</td>
        </tr>
            <th>タスク</th>
            <td>{{$task->content}}</td>
        </tr>
        <tr>
            <th>締切日</th>
            <td>{{$task->deadline}}</td>
        </tr>
        <tr>
            <th>進捗率</th>
            <td>{{$task->progress}}</td>
        </tr>
        <tr>
            <th>優先度</th>
            <td>{{$task->priority}}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{$task->status}}</td>
        </tr>
        
        
    </table>
    
    {!! link_to_route('tasks.edit','このタスクを更新する',['task'=>$task->id],['class' => 'btn btn-light']) !!}
    {!! Form::model($task, ['route' => ['tasks.destroy',$task->id],'method' => 'delete']) !!}
        {!! Form::submit('削除',['class' =>'btn btn-danger'])!!}
    
@endsection