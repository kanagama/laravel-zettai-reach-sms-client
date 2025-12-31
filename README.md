# laravel-zettai-reach-sms-client

絶対リーチSMS API の Laravel クライアントライブラリです。

## 目次

- [インストール](#インストール)
- [設定](#設定)
- [使用方法](#使用方法)
  - [CommonMT 送信](#commonmt-送信)
  - [CommonMT 予約送信確認](#commonmt-予約送信確認)
  - [CommonMT 予約送信キャンセル](#commonmt-予約送信キャンセル)
  - [CommonMT 予約送信一括キャンセル](#commonmt-予約送信一括キャンセル)
  - [CommonMT ステータス取得](#commonmt-ステータス取得)
  - [ショート URL 登録](#ショート-url-登録)
  - [登録済み定型文取得](#登録済み定型文取得)
  - [電話番号クリーニング](#電話番号クリーニング)
  - [通数集計](#通数集計)

## インストール

Composer を使用してインストールします。

```bash
composer require kanagama/laravel-zettai-reach-sms-client
```

## 設定

### config ファイルの公開

以下のコマンドで設定ファイルを公開します。

```bash
php artisan vendor:publish --tag=zettai-reach-sms-config
```

これにより、`config/zettai-reach-sms.php` ファイルが作成されます。

### 環境変数の設定

`.env` ファイルに以下の環境変数を追加してください。

```env
ZETTAI_REACH_SMS_TOKEN=your-api-token-here
ZETTAI_REACH_SMS_CLIENT_ID=your-client-id-here
ZETTAI_REACH_SMS_TIMEOUT_SECONDS=10
```

- `ZETTAI_REACH_SMS_TOKEN`: アカウント登録時に発行されるアクセスキー（32文字の半角英数字）
- `ZETTAI_REACH_SMS_CLIENT_ID`: 契約クライアントID（半角数字）
- `ZETTAI_REACH_SMS_TIMEOUT_SECONDS`: タイムアウト時間（秒、デフォルト: 10）

### config ファイルの内容

`config/zettai-reach-sms.php` の内容は以下の通りです。

```php
<?php
declare(strict_types=1);

return [
    'token'           => env('ZETTAI_REACH_SMS_TOKEN', ''),
    'client_id'       => env('ZETTAI_REACH_SMS_CLIENT_ID', ''),
    'timeout_seconds' => (int) env('ZETTAI_REACH_SMS_TIMEOUT_SECONDS', 10),
];
```

## 使用方法

このライブラリは、静的呼び出しと動的呼び出しの両方をサポートしています。

### CommonMT 送信

SMS を送信します。予約送信も可能です。

#### 静的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// 即時送信
$response = ZettaiReachSmsClient::send(
    phoneNumber: '09012345678',
    message: 'これはテストメッセージです。',
);

// オプションパラメータを指定した送信
$response = ZettaiReachSmsClient::send(
    phoneNumber: '09012345678',
    message: 'これはテストメッセージです。',
    carrierId: '101',           // キャリアID（101: docomo, 103: au, 105: SoftBank, 106: 楽天モバイル）
    clientTag: 'unique-tag-001', // 送信ステータス確認用のユニークな識別文字列
    scheduleTime: '2025-12-31 15:00', // 予約送信時間（yyyy-MM-dd HH:mm 形式）
    groupTag: 'campaign-001',    // 予約確認・一括キャンセル用の識別文字列
);
```

#### 動的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function sendSms(): void
{
    // 即時送信
    $response = $this->smsClient->send(
        phoneNumber: '09012345678',
        message: 'これはテストメッセージです。',
    );
    
    // オプションパラメータを指定した送信
    $response = $this->smsClient->send(
        phoneNumber: '09012345678',
        message: 'これはテストメッセージです。',
        carrierId: '101',
        clientTag: 'unique-tag-001',
        scheduleTime: '2025-12-31 15:00',
        groupTag: 'campaign-001',
    );
}
```

#### レスポンス例

```php
[
    'responseCode' => 0,                    // 0: 成功, 1以上: エラー
    'responseMessage' => 'Success.',        // 応答メッセージ
    'phoneNumber' => '+819012345678',       // 送信先電話番号（国際電話番号形式）
    'smsMessage' => 'これはテストメッセージです。', // 送信したメッセージ
]
```

### CommonMT 予約送信確認

予約送信の状態を確認します。

#### 静的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// clientTag で確認
$response = ZettaiReachSmsClient::checkReservation(
    clientTag: 'unique-tag-001',
);

// scheduleTime で確認
$response = ZettaiReachSmsClient::checkReservation(
    scheduleTime: '2025-12-31 15:00',
);

// scheduleDate で確認
$response = ZettaiReachSmsClient::checkReservation(
    scheduleDate: '20251231',
);

// scheduleTime と groupTag の組み合わせで確認
$response = ZettaiReachSmsClient::checkReservation(
    scheduleTime: '2025-12-31 15:00',
    groupTag: 'campaign-001',
);
```

#### 動的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function checkReservation(): void
{
    // clientTag で確認
    $response = $this->smsClient->checkReservation(
        clientTag: 'unique-tag-001',
    );
    
    // scheduleDate と groupTag の組み合わせで確認
    $response = $this->smsClient->checkReservation(
        scheduleDate: '20251231',
        groupTag: 'campaign-001',
    );
}
```

#### レスポンス例

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー
    'responseMessage' => 'Success.',
    'count' => 1,               // 予約送信の件数
    'status' => [               // 予約送信のステータス情報の配列
        [
            'clientTag' => 'unique-tag-001',
            'phoneNumber' => '+819012345678',
            'smsMessage' => 'これはテストメッセージです。',
            'sendStatus' => 0,  // 0: 送信待ち, 1: 送信中, 2: 送信完了, 3: 送信失敗, 9: キャンセル済み
            'scheduleTime' => '2025-12-31 15:00:00',
        ],
    ],
]
```

### CommonMT 予約送信キャンセル

予約送信をキャンセルします。

#### 静的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// clientTag でキャンセル
$response = ZettaiReachSmsClient::cancelReservation(
    clientTag: 'unique-tag-001',
);

// scheduleTime でキャンセル
$response = ZettaiReachSmsClient::cancelReservation(
    scheduleTime: '2025-12-31 15:00',
);

// scheduleDate でキャンセル
$response = ZettaiReachSmsClient::cancelReservation(
    scheduleDate: '20251231',
);

// groupTag でまとめてキャンセル
$response = ZettaiReachSmsClient::cancelReservation(
    scheduleTime: '2025-12-31 15:00',
    groupTag: 'campaign-001',
);
```

#### 動的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function cancelReservation(): void
{
    // clientTag でキャンセル
    $response = $this->smsClient->cancelReservation(
        clientTag: 'unique-tag-001',
    );
    
    // groupTag でまとめてキャンセル
    $response = $this->smsClient->cancelReservation(
        scheduleDate: '20251231',
        groupTag: 'campaign-001',
    );
}
```

#### レスポンス例

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー
    'responseMessage' => 'Success.',
    'count' => 1,               // キャンセルした予約送信の件数
]
```

### CommonMT 予約送信一括キャンセル

指定した日付の予約送信をすべてキャンセルします。

#### 静的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// 指定日の予約送信をすべてキャンセル
$response = ZettaiReachSmsClient::cancelReservationAll(
    scheduleDate: '20251231', // yyyyMMdd 形式
);
```

#### 動的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function cancelAllReservations(): void
{
    $response = $this->smsClient->cancelReservationAll(
        scheduleDate: '20251231',
    );
}
```

#### レスポンス例

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー
    'responseMessage' => 'Success.',
    'count' => 5,               // キャンセルした予約送信の件数
]
```

### CommonMT ステータス取得

送信した SMS のステータスを取得します。

#### 静的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

$response = ZettaiReachSmsClient::status(
    clientTag: 'unique-tag-001',
);
```

#### 動的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function getStatus(): void
{
    $response = $this->smsClient->status(
        clientTag: 'unique-tag-001',
    );
}
```

#### レスポンス例

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー
    'responseMessage' => 'Success.',
    'clientTag' => 'unique-tag-001',
    'phoneNumber' => '+819012345678',
    'smsMessage' => 'これはテストメッセージです。',
    'sendStatus' => 2,          // 0: 送信待ち, 1: 送信中, 2: 送信完了, 3: 送信失敗, 9: キャンセル済み
    'carrierStatus' => 0,       // キャリアから返却されるステータスコード
    'sendTime' => '2025-12-31 15:00:00',
    'receiveTime' => '2025-12-31 15:00:05',
]
```

### ショート URL 登録

長い URL をショート URL に変換します。

#### 静的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// デフォルトドメインで変換
$response = ZettaiReachSmsClient::shortenUrl(
    longUrl: 'https://example.com/very/long/url/path/to/page',
);

// カスタムドメインで変換
$response = ZettaiReachSmsClient::shortenUrl(
    longUrl: 'https://example.com/very/long/url/path/to/page',
    domain: 'custom.example.com',
);
```

#### 動的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function createShortUrl(): void
{
    // デフォルトドメインで変換
    $response = $this->smsClient->shortenUrl(
        longUrl: 'https://example.com/very/long/url/path/to/page',
    );
    
    // カスタムドメインで変換
    $response = $this->smsClient->shortenUrl(
        longUrl: 'https://example.com/very/long/url/path/to/page',
        domain: 'custom.example.com',
    );
}
```

#### レスポンス例

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー
    'responseMessage' => 'Success.',
    'shortUrl' => 'https://short.url/abc123', // 生成されたショート URL
]
```

### 登録済み定型文取得

アカウントに登録されている定型文の一覧を取得します。

#### 静的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

$response = ZettaiReachSmsClient::template();
```

#### 動的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function getTemplates(): void
{
    $response = $this->smsClient->template();
}
```

#### レスポンス例

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー
    'responseMessage' => 'Success.',
    'count' => 2,               // 登録済み定型文の件数
    'templates' => [            // 登録済み定型文の配列
        [
            'templateId' => '1',
            'templateName' => 'お知らせテンプレート',
            'message' => 'お知らせ: {content}',
        ],
        [
            'templateId' => '2',
            'templateName' => '確認コードテンプレート',
            'message' => 'あなたの確認コードは {code} です。',
        ],
    ],
]
```

### 電話番号クリーニング

電話番号の妥当性を検証し、キャリア情報を取得します。

#### 静的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// 日本国内形式で指定
$response = ZettaiReachSmsClient::numberCleaning(
    phoneNumber: '09012345678',
);

// 国際電話番号形式で指定
$response = ZettaiReachSmsClient::numberCleaning(
    phoneNumber: '+819012345678',
);
```

#### 動的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function validatePhoneNumber(): void
{
    $response = $this->smsClient->numberCleaning(
        phoneNumber: '09012345678',
    );
}
```

#### レスポンス例

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー
    'responseMessage' => 'Success.',
    'phoneNumber' => '+819012345678',  // クリーニング後の電話番号（国際電話番号形式）
    'carrierId' => '101',       // 101: docomo, 103: au, 105: SoftBank, 106: 楽天モバイル
    'status' => 'valid',        // valid: 有効, invalid: 無効, unknown: 判定不可
]
```

### 通数集計

指定期間内の送信成功件数を集計します。

#### 静的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

$response = ZettaiReachSmsClient::separatedSuccessCount(
    startDate: '20251201',  // yyyyMMdd 形式
    endDate: '20251231',    // yyyyMMdd 形式
);
```

#### 動的呼び出し

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function getSuccessCount(): void
{
    $response = $this->smsClient->separatedSuccessCount(
        startDate: '20251201',
        endDate: '20251231',
    );
}
```

#### レスポンス例

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー
    'responseMessage' => 'Success.',
    'totalCount' => 1500,       // 指定期間内の総送信成功件数
    'separatedCount' => [       // キャリア別の送信成功件数の配列
        [
            'carrierId' => '101',   // docomo
            'carrierName' => 'NTT docomo',
            'count' => 500,
        ],
        [
            'carrierId' => '103',   // au
            'carrierName' => 'au',
            'count' => 450,
        ],
        [
            'carrierId' => '105',   // SoftBank
            'carrierName' => 'SoftBank',
            'count' => 450,
        ],
        [
            'carrierId' => '106',   // 楽天モバイル
            'carrierName' => 'Rakuten Mobile',
            'count' => 100,
        ],
    ],
]
```

## ライセンス

このプロジェクトは MIT ライセンスの下で公開されています。詳細は [LICENSE](LICENSE) ファイルをご覧ください。
