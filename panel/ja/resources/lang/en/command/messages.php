<?php

return [
    'location' => [
        'no_location_found' => '指定されたショートコードに一致するレコードが見つかりませんでした。',
        'ask_short' => 'ロケーションのショートコード',
        'ask_long' => 'ロケーションの説明',
        'created' => '新しいロケーション(:name)をID :id で正常に作成しました。',
        'deleted' => '要求されたロケーションを正常に削除しました。',
    ],
    'user' => [
        'search_users' => 'ユーザー名、ユーザーID、またはメールアドレスを入力してください',
        'select_search_user' => '削除するユーザーのID（再検索する場合は \'0\' を入力）',
        'deleted' => 'ユーザーがパネルから正常に削除されました。',
        'confirm_delete' => 'このユーザーをパネルから削除してもよろしいですか？',
        'no_users_found' => '入力された検索語に一致するユーザーは見つかりませんでした。',
        'multiple_found' => '指定されたユーザーに複数のアカウントが見つかりました。--no-interactionフラグが指定されているため、ユーザーを削除できません。',
        'ask_admin' => 'このユーザーは管理者ですか？',
        'ask_email' => 'メールアドレス',
        'ask_username' => 'ユーザー名',
        'ask_name_first' => '名',
        'ask_name_last' => '姓',
        'ask_password' => 'パスワード',
        'ask_password_tip' => 'ランダムパスワードでアカウントを作成しユーザーにメール送信する場合は、このコマンドを中断（CTRL+C）して、`--no-password`フラグを付けて再実行してください。',
        'ask_password_help' => 'パスワードは8文字以上で、少なくとも1つの大文字と数字を含める必要があります。',
        '2fa_help_text' => [
            'このコマンドは、ユーザーアカウントの2要素認証が有効な場合に無効化します。これはユーザーがアカウントにログインできなくなった際のアカウント復旧コマンドとしてのみ使用してください。',
            'これが意図した操作でない場合は、CTRL+Cを押してこのプロセスを終了してください。',
        ],
        '2fa_disabled' => ':emailの2要素認証が無効化されました。',
    ],
    'schedule' => [
        'output_line' => '`:schedule`(:hash)の最初のタスクのジョブをディスパッチしています。',
    ],
    'maintenance' => [
        'deleting_service_backup' => 'サービスバックアップファイル :file を削除しています。',
    ],
    'server' => [
        'rebuild_failed' => 'ノード ":node" の ":name"(#:id)の再ビルドリクエストがエラーで失敗しました: :message',
        'reinstall' => [
            'failed' => 'ノード ":node" の ":name"(#:id)の再インストールリクエストがエラーで失敗しました: :message',
            'confirm' => 'サーバーのグループに対して再インストールを実行しようとしています。続行しますか？',
        ],
        'power' => [
            'confirm' => ':count台のサーバーに対して :action を実行しようとしています。続行しますか？',
            'action_failed' => 'ノード ":node" の ":name"(#:id)の電源操作リクエストがエラーで失敗しました: :message',
        ],
    ],
    'environment' => [
        'mail' => [
            'ask_smtp_host' => 'SMTPホスト（例: smtp.gmail.com）',
            'ask_smtp_port' => 'SMTPポート',
            'ask_smtp_username' => 'SMTPユーザー名',
            'ask_smtp_password' => 'SMTPパスワード',
            'ask_mailgun_domain' => 'Mailgunドメイン',
            'ask_mailgun_endpoint' => 'Mailgunエンドポイント',
            'ask_mailgun_secret' => 'Mailgunシークレット',
            'ask_mandrill_secret' => 'Mandrillシークレット',
            'ask_postmark_username' => 'Postmark APIキー',
            'ask_driver' => 'メール送信にどのドライバーを使用しますか？',
            'ask_mail_from' => 'メールの送信元メールアドレス',
            'ask_mail_name' => 'メールの送信元名',
            'ask_encryption' => '使用する暗号化方式',
        ],
    ],
];
