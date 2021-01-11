@extends('layouts.app')

@section('content')

<h1>項番：{{$task->id}}のタスク編集ページ</h1>
    <div class="row">
        
        <div class="col-8">
            {!! Form::model($task, ['route' => ['tasks.update',$task->id], 'method' =>'put']) !!}
                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', $task->content, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <?php
                    $deadline=[
                        date("Ymd")=>'今日',
                        date("Ymd",strtotime("1 day"))=>'明日',
                        date("Ymd",strtotime("2 day"))=>'明後日以降',];
                    ?>
                    {!! Form::label('deadline', '締切:') !!}
                    {!! Form::select('deadline', $deadline, '', ['placeholder'=>'締切日を入れてください(必須)','class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <?php
                    $percent=[
                        '0'=>'0',
                        '10'=>'10',
                        '20'=>'20',
                        '30'=>'30',
                        '40'=>'40',
                        '50'=>'50',
                        '60'=>'60',
                        '70'=>'70',
                        '80'=>'80',
                        '90'=>'90',
                        '100'=>'100',];
                    ?>
                    {!! Form::label('progress', '進捗率(%):') !!}
                    {!! Form::select('progress',$percent , $task->progress, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <?php
                    $hml=[
                        '高'=>'高',
                        '中'=>'中',
                        '低'=>'低',];
                    ?>
                    {!! Form::label('priority', '優先度:') !!}
                    {!! Form::select('priority', $hml, $task->priority, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'ステータス:') !!}
                    {!! Form::text('status', $task->status, ['class' => 'form-control']) !!}
                </div>
                    {!! Form::submit('更新する', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
            </div>
    </div>

@endsection