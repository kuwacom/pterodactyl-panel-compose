<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attributeを承認してください。',
    'active_url' => ':attributeは有効なURLではありません。',
    'after' => ':attributeは:dateより後の日付である必要があります。',
    'after_or_equal' => ':attributeは:date以降の日付である必要があります。',
    'alpha' => ':attributeは文字のみ使用できます。',
    'alpha_dash' => ':attributeは文字、数字、ダッシュのみ使用できます。',
    'alpha_num' => ':attributeは文字と数字のみ使用できます。',
    'array' => ':attributeは配列である必要があります。',
    'before' => ':attributeは:dateより前の日付である必要があります。',
    'before_or_equal' => ':attributeは:date以前の日付である必要があります。',
    'between' => [
        'numeric' => ':attributeは:minから:maxの間である必要があります。',
        'file' => ':attributeは:min KBから:max KBの間である必要があります。',
        'string' => ':attributeは:min文字から:max文字の間である必要があります。',
        'array' => ':attributeは:min個から:max個の項目である必要があります。',
    ],
    'boolean' => ':attributeフィールドはtrueまたはfalseである必要があります。',
    'confirmed' => ':attributeの確認が一致しません。',
    'date' => ':attributeは有効な日付ではありません。',
    'date_format' => ':attributeは:format形式と一致しません。',
    'different' => ':attributeと:otherは異なる必要があります。',
    'digits' => ':attributeは:digits桁である必要があります。',
    'digits_between' => ':attributeは:min桁から:max桁の間である必要があります。',
    'dimensions' => ':attributeの画像サイズが無効です。',
    'distinct' => ':attributeフィールドに重複した値があります。',
    'email' => ':attributeは有効なメールアドレスである必要があります。',
    'exists' => '選択された:attributeは無効です。',
    'file' => ':attributeはファイルである必要があります。',
    'filled' => ':attributeフィールドは必須です。',
    'image' => ':attributeは画像である必要があります。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attributeフィールドは:otherに存在しません。',
    'integer' => ':attributeは整数である必要があります。',
    'ip' => ':attributeは有効なIPアドレスである必要があります。',
    'json' => ':attributeは有効なJSON文字列である必要があります。',
    'max' => [
        'numeric' => ':attributeは:maxを超えることはできません。',
        'file' => ':attributeは:max KBを超えることはできません。',
        'string' => ':attributeは:max文字を超えることはできません。',
        'array' => ':attributeは:max個より多い項目を持つことはできません。',
    ],
    'mimes' => ':attributeは次の形式のファイルである必要があります: :values。',
    'mimetypes' => ':attributeは次の形式のファイルである必要があります: :values。',
    'min' => [
        'numeric' => ':attributeは:min以上である必要があります。',
        'file' => ':attributeは:min KB以上である必要があります。',
        'string' => ':attributeは:min文字以上である必要があります。',
        'array' => ':attributeは:min個以上の項目である必要があります。',
    ],
    'not_in' => '選択された:attributeは無効です。',
    'numeric' => ':attributeは数値である必要があります。',
    'present' => ':attributeフィールドが存在している必要があります。',
    'regex' => ':attributeの形式が無効です。',
    'required' => ':attributeフィールドは必須です。',
    'required_if' => ':otherが:valueの場合、:attributeフィールドは必須です。',
    'required_unless' => ':otherが:valuesに含まれない場合、:attributeフィールドは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_with_all' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
    'required_without_all' => ':valuesのいずれも存在しない場合、:attributeフィールドは必須です。',
    'same' => ':attributeと:otherは一致している必要があります。',
    'size' => [
        'numeric' => ':attributeは:sizeである必要があります。',
        'file' => ':attributeは:size KBである必要があります。',
        'string' => ':attributeは:size文字である必要があります。',
        'array' => ':attributeは:size個の項目を含む必要があります。',
    ],
    'string' => ':attributeは文字列である必要があります。',
    'timezone' => ':attributeは有効なタイムゾーンである必要があります。',
    'unique' => ':attributeはすでに使用されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url' => ':attributeの形式が無効です。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

    // Internal validation logic for Pterodactyl
    'internal' => [
        'variable_value' => ':env 変数',
        'invalid_password' => '入力されたパスワードはこのアカウントに対して無効です。',
    ],
];
