@extends('layouts.admin')

@section('title')
    ノード &rarr; 新規
@endsection

@section('content-header')
    <h1>新規ノード<small>サーバーをインストールするための新しいローカルまたはリモートノードを作成します。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理者</a></li>
        <li><a href="{{ route('admin.nodes') }}">ノード</a></li>
        <li class="active">新規</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.nodes.new') }}" method="POST">
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">基本情報</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">名前</label>
                        <input type="text" name="name" id="pName" class="form-control" value="{{ old('name') }}"/>
                        <p class="text-muted small">文字制限: <code>a-zA-Z0-9_.-</code> および <code>[スペース]</code>（最小1、最大100文字）。</p>
                    </div>
                    <div class="form-group">
                        <label for="pDescription" class="form-label">説明</label>
                        <textarea name="description" id="pDescription" rows="4" class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="pLocationId" class="form-label">ロケーション</label>
                        <select name="location_id" id="pLocationId">
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $location->id != old('location_id') ?: 'selected' }}>{{ $location->short }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">ノードの公開設定</label>
                        <div>
                            <div class="radio radio-success radio-inline">

                                <input type="radio" id="pPublicTrue" value="1" name="public" checked>
                                <label for="pPublicTrue"> 公開 </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pPublicFalse" value="0" name="public">
                                <label for="pPublicFalse"> 非公開 </label>
                            </div>
                        </div>
                        <p class="text-muted small">ノードを<code>非公開</code>に設定すると、このノードへの自動デプロイ機能が無効になります。
                    </div>
                    <div class="form-group">
                        <label for="pFQDN" class="form-label">FQDN</label>
                        <input type="text" name="fqdn" id="pFQDN" class="form-control" value="{{ old('fqdn') }}"/>
                        <p class="text-muted small">デーモンへの接続に使用するドメイン名（例: <code>node.example.com</code>）を入力してください。このノードでSSLを使用しない場合のみ、IPアドレスを使用できます。</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">SSL通信</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pSSLTrue" value="https" name="scheme" checked>
                                <label for="pSSLTrue"> SSL接続を使用</label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pSSLFalse" value="http" name="scheme" @if(request()->isSecure()) disabled @endif>
                                <label for="pSSLFalse"> HTTP接続を使用</label>
                            </div>
                        </div>
                        @if(request()->isSecure())
                            <p class="text-danger small">パネルは現在セキュア接続を使用するように設定されています。ブラウザがノードに接続するためには、<strong>SSL接続を使用する必要があります</strong>。</p>
                        @else
                            <p class="text-muted small">ほとんどの場合、SSL接続の使用を選択すべきです。IPアドレスを使用している場合、またはSSLを一切使用したくない場合は、HTTP接続を選択してください。</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">プロキシ背後</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pProxyFalse" value="0" name="behind_proxy" checked>
                                <label for="pProxyFalse"> プロキシ背後ではない </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="pProxyTrue" value="1" name="behind_proxy">
                                <label for="pProxyTrue"> プロキシ背後 </label>
                            </div>
                        </div>
                        <p class="text-muted small">Cloudflareなどのプロキシ背後でデーモンを実行している場合、これを選択するとデーモンは起動時の証明書検索をスキップします。</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">設定</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pDaemonBase" class="form-label">デーモンサーバーファイルディレクトリ</label>
                            <input type="text" name="daemonBase" id="pDaemonBase" class="form-control" value="/var/lib/pterodactyl/volumes" />
                            <p class="text-muted small">サーバーファイルを保存するディレクトリを入力してください。<strong>OVHを使用している場合は、パーティション構成を確認してください。十分な容量を確保するために <code>/home/daemon-data</code> を使用する必要がある場合があります。</strong></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pMemory" class="form-label">総メモリ</label>
                            <div class="input-group">
                                <input type="text" name="memory" data-multiplicator="true" class="form-control" id="pMemory" value="{{ old('memory') }}"/>
                                <span class="input-group-addon">MiB</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pMemoryOverallocate" class="form-label">メモリ割り当て超過</label>
                            <div class="input-group">
                                <input type="text" name="memory_overallocate" class="form-control" id="pMemoryOverallocate" value="{{ old('memory_overallocate') }}"/>
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted small">新しいサーバーに利用可能なメモリの総量を入力してください。メモリの割り当て超過を許可したい場合は、許可したい割合を入力してください。割り当て超過のチェックを無効にするには <code>-1</code> を入力してください。<code>0</code> を入力すると、ノードが制限を超える場合に新しいサーバーの作成を防ぎます。</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pDisk" class="form-label">総ディスク容量</label>
                            <div class="input-group">
                                <input type="text" name="disk" data-multiplicator="true" class="form-control" id="pDisk" value="{{ old('disk') }}"/>
                                <span class="input-group-addon">MiB</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pDiskOverallocate" class="form-label">ディスク割り当て超過</label>
                            <div class="input-group">
                                <input type="text" name="disk_overallocate" class="form-control" id="pDiskOverallocate" value="{{ old('disk_overallocate') }}"/>
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted small">新しいサーバーに利用可能なディスク容量の総量を入力してください。ディスク容量の割り当て超過を許可したい場合は、許可したい割合を入力してください。割り当て超過のチェックを無効にするには <code>-1</code> を入力してください。<code>0</code> を入力すると、ノードが制限を超える場合に新しいサーバーの作成を防ぎます。</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pDaemonListen" class="form-label">デーモンポート</label>
                            <input type="text" name="daemonListen" class="form-control" id="pDaemonListen" value="8080" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pDaemonSFTP" class="form-label">デーモンSFTPポート</label>
                            <input type="text" name="daemonSFTP" class="form-control" id="pDaemonSFTP" value="2022" />
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted small">デーモンは独自のSFTP管理コンテナを実行し、メインの物理サーバー上のSSHdプロセスを使用しません。<strong>物理サーバーのSSHプロセスに割り当てたポートと同じポートを使用しないでください。</strong>CloudFlare&reg; 背後でデーモンを実行する場合、SSL経由のWebSocketプロキシを許可するためにデーモンポートを <code>8443</code> に設定する必要があります。</p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-success pull-right">ノードを作成</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('#pLocationId').select2();
    </script>
@endsection
