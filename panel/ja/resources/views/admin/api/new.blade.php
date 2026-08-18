@extends('layouts.admin')

@section('title')
    アプリケーション API
@endsection

@section('content-header')
    <h1>アプリケーション API<small>新しいアプリケーションAPIキーを作成。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理者</a></li>
        <li><a href="{{ route('admin.api.index') }}">アプリケーション API</a></li>
        <li class="active">新しい認証情報</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <form method="POST" action="{{ route('admin.api.new') }}">
            <div class="col-sm-8 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">パーミッションを選択</h3>
                        <div class="box-tools">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-default" id="btn-bulk-read">すべて読み取り</button>
                                <button type="button" class="btn btn-sm btn-default" id="btn-bulk-rw">すべて読み取り &amp; 書き込み</button>
                                <button type="button" class="btn btn-sm btn-default" id="btn-bulk-none">すべてなし</button>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover" style="min-width: 650px;">
                            @foreach($resources as $resource)
                                <tr>
                                    <td class="strong" style="vertical-align: middle; padding-left: 15px;">
                                        {{ str_replace('_', ' ', title_case($resource)) }}
                                    </td>
                                    
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div class="radio radio-primary" style="margin: 0;">
                                            <input type="radio" id="r_{{ $resource }}" name="r_{{ $resource }}" value="{{ $permissions['r'] }}">
                                            <label for="r_{{ $resource }}">読み取り</label>
                                        </div>
                                    </td>
                                    
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div class="radio radio-primary" style="margin: 0;">
                                            <input type="radio" id="rw_{{ $resource }}" name="r_{{ $resource }}" value="{{ $permissions['rw'] }}">
                                            <label for="rw_{{ $resource }}">読み取り &amp; 書き込み</label>
                                        </div>
                                    </td>
                                    
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div class="radio" style="margin: 0;">
                                            <input type="radio" id="n_{{ $resource }}" name="r_{{ $resource }}" value="{{ $permissions['n'] }}" checked>
                                            <label for="n_{{ $resource }}">なし</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label" for="memoField">説明 <span class="field-required"></span></label>
                            <input id="memoField" type="text" name="memo" class="form-control">
                        </div>
                        <p class="text-muted">パーミッションを割り当ててこの認証情報を作成すると、後で編集することはできません。後で変更が必要な場合は、新しい認証情報を作成する必要があります。</p>
                    </div>
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success btn-sm pull-right">認証情報を作成</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('footer-scripts')
    @parent
    <script>
        $(document).ready(function() {
            
            function setButtonActive(activeButton) {
                $('#btn-bulk-read, #btn-bulk-rw, #btn-bulk-none')
                    .removeClass('btn-primary')
                    .addClass('btn-default');
                $(activeButton)
                    .removeClass('btn-default')
                    .addClass('btn-primary');
            }

            
            setButtonActive('#btn-bulk-none');

            $('#btn-bulk-read').click(function(e) {
                e.preventDefault();
                $('input[id^="r_"]').prop('checked', true);
                setButtonActive(this); 
            });

            $('#btn-bulk-rw').click(function(e) {
                e.preventDefault();
                $('input[id^="rw_"]').prop('checked', true);
                setButtonActive(this); 
            });

            $('#btn-bulk-none').click(function(e) {
                e.preventDefault();
                $('input[id^="n_"]').prop('checked', true);
                setButtonActive(this); 
            });
            
            
            $('input[type="radio"]').change(function() {
                $('#btn-bulk-read, #btn-bulk-rw, #btn-bulk-none')
                    .removeClass('btn-primary')
                    .addClass('btn-default');
            });
        });
    </script>
@endsection
