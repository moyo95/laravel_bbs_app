<!DOCUTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問合せ</title>
</head>
<body>
    <h1>{{ $role === 'admin' ? 'お問合せ' : 'お問合せ内容' }}</h1>
    <p><strong>お名前</strong>{{ $contact['name' ]}}</p>
    <p><strong>メールアドレス</strong>{{ $contact['email' ]}}</p>
    <p><strong>メッセージ</strong>{{ $contact['message' ]}}</p>
</body>

</html>