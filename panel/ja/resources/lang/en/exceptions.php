<?php

return [
    'daemon_connection_failed' => 'デーモンとの通信中に例外が発生し、HTTP/:codeレスポンスコードが返されました。この例外はログに記録されました。',
    'node' => [
        'servers_attached' => 'ノードにリンクされているサーバーがない状態でのみ削除可能です。',
        'daemon_off_config_updated' => 'デーモン設定は更新されましたが、デーモン上の設定ファイルを自動更新中にエラーが発生しました。これらの変更を適用するには、デーモンの設定ファイル（config.yml）を手動で更新する必要があります。',
    ],
    'allocations' => [
        'server_using' => 'サーバーが現在この割り当てに割り当てられています。割り当ては、現在割り当てられているサーバーがない場合のみ削除できます。',
        'too_many_ports' => '一度に1000ポートを超える範囲の追加はサポートされていません。',
        'invalid_mapping' => ':port に対して指定されたマッピングが無効で、処理できませんでした。',
        'cidr_out_of_range' => 'CIDR表記では/25から/32の間のマスクのみ指定可能です。',
        'port_out_of_range' => '割り当てのポートは1024より大きく65535以下である必要があります。',
    ],
    'nest' => [
        'delete_has_servers' => 'アクティブなサーバーが紐付けられているNestはパネルから削除できません。',
        'egg' => [
            'delete_has_servers' => 'アクティブなサーバーが紐付けられているEggはパネルから削除できません。',
            'invalid_copy_id' => 'スクリプトのコピー元として選択されたEggは存在しないか、スクリプト自身をコピーしています。',
            'must_be_child' => 'このEggの「設定のコピー元」ディレクティブは、選択したNestの子オプションである必要があります。',
            'has_children' => 'このEggは1つ以上の他のEggの親となっています。このEggを削除する前に、それらのEggを削除してください。',
        ],
        'variables' => [
            'env_not_unique' => '環境変数 :name はこのEgg内で一意である必要があります。',
            'reserved_name' => '環境変数 :name は保護されており、変数に割り当てることはできません。',
            'bad_validation_rule' => 'バリデーションルール ":rule" はこのアプリケーションで有効なルールではありません。',
        ],
        'importer' => [
            'json_error' => 'JSONファイルの解析中にエラーが発生しました: :error。',
            'file_error' => '指定されたJSONファイルは有効ではありません。',
            'invalid_json_provided' => '指定されたJSONファイルは認識可能な形式ではありません。',
        ],
    ],
    'subusers' => [
        'editing_self' => '自分自身のサブユーザーアカウントを編集することは許可されていません。',
        'user_is_owner' => 'サーバーの所有者をこのサーバーのサブユーザーとして追加することはできません。',
        'subuser_exists' => 'そのメールアドレスのユーザーは既にこのサーバーのサブユーザーとして割り当てられています。',
    ],
    'databases' => [
        'delete_has_databases' => 'アクティブなデータベースがリンクされているデータベースホストサーバーは削除できません。',
    ],
    'tasks' => [
        'chain_interval_too_long' => 'チェーンタスクの最大間隔時間は15分です。',
    ],
    'locations' => [
        'has_nodes' => 'アクティブなノードが紐付けられているロケーションは削除できません。',
    ],
    'users' => [
        'node_revocation_failed' => '<a href=":link">ノード #:node</a> のキー失効に失敗しました。:error',
    ],
    'deployment' => [
        'no_viable_nodes' => '自動デプロイの要件を満たすノードが見つかりませんでした。',
        'no_viable_allocations' => '自動デプロイの要件を満たす割り当てが見つかりませんでした。',
    ],
    'api' => [
        'resource_not_found' => '要求されたリソースはこのサーバーに存在しません。',
    ],
];
