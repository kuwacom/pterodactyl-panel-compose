<?php

/**
 * Contains all of the translation strings for different activity log
 * events. These should be keyed by the value in front of the colon (:)
 * in the event name. If there is no colon present, they should live at
 * the top level.
 */
return [
    'auth' => [
        'fail' => 'ログイン失敗',
        'success' => 'ログイン成功',
        'password-reset' => 'パスワードリセット',
        'reset-password' => 'パスワードリセットを要求',
        'checkpoint' => '2要素認証を要求',
        'recovery-token' => '2要素認証リカバリトークンを使用',
        'token' => '2要素認証チャレンジを解決',
        'ip-blocked' => 'リスト外IPアドレスからのリクエストをブロック: :identifier',
        'sftp' => [
            'fail' => 'SFTPログイン失敗',
        ],
    ],
    'user' => [
        'user' => [
            'create' => '新しいユーザーを作成: :email',
        ],
        'account' => [
            'email-changed' => 'メールアドレスを :old から :new に変更',
            'password-changed' => 'パスワードを変更',
        ],
        'api-key' => [
            'create' => '新しいAPIキーを作成: :identifier',
            'delete' => 'APIキーを削除: :identifier',
        ],
        'ssh-key' => [
            'create' => 'SSHキーをアカウントに追加: :fingerprint',
            'delete' => 'SSHキーをアカウントから削除: :fingerprint',
        ],
        'two-factor' => [
            'create' => '2要素認証を有効化',
            'delete' => '2要素認証を無効化',
        ],
    ],
    'server' => [
        'reinstall' => 'サーバーを再インストール',
        'console' => [
            'command' => 'サーバーで ":command" を実行',
        ],
        'power' => [
            'start' => 'サーバーを起動',
            'stop' => 'サーバーを停止',
            'restart' => 'サーバーを再起動',
            'kill' => 'サーバープロセスを強制終了',
        ],
        'backup' => [
            'download' => 'バックアップ :name をダウンロード',
            'delete' => 'バックアップ :name を削除',
            'restore' => 'バックアップ :name を復元（削除されたファイル: :truncate）',
            'restore-complete' => 'バックアップ :name の復元が完了',
            'restore-failed' => 'バックアップ :name の復元に失敗',
            'start' => '新しいバックアップを開始: :name',
            'complete' => 'バックアップ :name を完了としてマーク',
            'fail' => 'バックアップ :name を失敗としてマーク',
            'lock' => 'バックアップ :name をロック',
            'unlock' => 'バックアップ :name のロックを解除',
        ],
        'database' => [
            'create' => '新しいデータベースを作成: :name',
            'rotate-password' => 'データベース :name のパスワードをローテーション',
            'delete' => 'データベース :name を削除',
        ],
        'file' => [
            'compress_one' => ':directory:files.0 を圧縮',
            'compress_other' => ':directory 内の :count ファイルを圧縮',
            'read' => ':file の内容を表示',
            'copy' => ':file のコピーを作成',
            'create-directory' => 'ディレクトリを作成: :directory:name',
            'decompress' => ':directory 内の :files を展開',
            'delete_one' => ':directory:files.0 を削除',
            'delete_other' => ':directory 内の :count ファイルを削除',
            'download' => ':file をダウンロード',
            'pull' => 'リモートファイルを :url から :directory にダウンロード',
            'rename_one' => ':directory:files.0.from を :directory:files.0.to にリネーム',
            'rename_other' => ':directory 内の :count ファイルをリネーム',
            'write' => ':file に新しい内容を書き込み',
            'upload' => 'ファイルのアップロードを開始',
            'uploaded' => ':directory:file をアップロード',
        ],
        'sftp' => [
            'denied' => '権限によりSFTPアクセスをブロック',
            'create_one' => ':files.0 を作成',
            'create_other' => ':count 個の新規ファイルを作成',
            'write_one' => ':files.0 の内容を変更',
            'write_other' => ':count 個のファイルの内容を変更',
            'delete_one' => ':files.0 を削除',
            'delete_other' => ':count 個のファイルを削除',
            'create-directory_one' => ':files.0 ディレクトリを作成',
            'create-directory_other' => ':count 個のディレクトリを作成',
            'rename_one' => ':files.0.from を :files.0.to にリネーム',
            'rename_other' => ':count 個のファイルをリネームまたは移動',
        ],
        'allocation' => [
            'create' => ':allocation をサーバーに追加',
            'notes' => ':allocation のメモを ":old" から ":new" に更新',
            'primary' => ':allocation をプライマリアロケーションに設定',
            'delete' => ':allocation アロケーションを削除',
        ],
        'schedule' => [
            'create' => 'スケジュール :name を作成',
            'update' => 'スケジュール :name を更新',
            'execute' => 'スケジュール :name を手動実行',
            'delete' => 'スケジュール :name を削除',
        ],
        'task' => [
            'create' => 'スケジュール :name に新しい ":action" タスクを作成',
            'update' => 'スケジュール :name の ":action" タスクを更新',
            'delete' => 'スケジュール :name のタスクを削除',
        ],
        'settings' => [
            'rename' => 'サーバー名を :old から :new に変更',
            'description' => 'サーバーの説明を :old から :new に変更',
        ],
        'startup' => [
            'edit' => ':variable 変数を ":old" から ":new" に変更',
            'image' => 'サーバーのDockerイメージを :old から :new に更新',
        ],
        'subuser' => [
            'create' => ':email をサブユーザーとして追加',
            'update' => ':email のサブユーザー権限を更新',
            'delete' => ':email をサブユーザーから削除',
        ],
    ],
];
