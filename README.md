# laravel-zettai-reach-sms-client

[絶対リーチSMS API](https://doc.aossms.com/zettai-reach/openapi.html) の Laravel クライアントライブラリです。

Laravel client library for Zettai Reach SMS API.

## 目次 / Table of Contents

- [インストール / Installation](#インストール--installation)
- [設定 / Configuration](#設定--configuration)
- [使用方法 / Usage](#使用方法--usage)
  - [CommonMT 送信 / Send SMS](#commonmt-送信--send-sms)
  - [CommonMT 予約送信確認 / Check Scheduled SMS](#commonmt-予約送信確認--check-scheduled-sms)
  - [CommonMT 予約送信キャンセル / Cancel Scheduled SMS](#commonmt-予約送信キャンセル--cancel-scheduled-sms)
  - [CommonMT 予約送信一括キャンセル / Cancel All Scheduled SMS](#commonmt-予約送信一括キャンセル--cancel-all-scheduled-sms)
  - [CommonMT ステータス取得 / Get Status](#commonmt-ステータス取得--get-status)
  - [ショート URL 登録 / Register Short URL](#ショート-url-登録--register-short-url)
  - [登録済み定型文取得 / Get Templates](#登録済み定型文取得--get-templates)
  - [電話番号クリーニング / Phone Number Cleaning](#電話番号クリーニング--phone-number-cleaning)
  - [通数集計 / Count Statistics](#通数集計--count-statistics)

## インストール / Installation

Composer を使用してインストールします。

Install using Composer.

```bash
composer require kanagama/laravel-zettai-reach-sms-client
```

## 設定 / Configuration

### config ファイルの公開 / Publish Configuration File

以下のコマンドで設定ファイルを公開します。

Publish the configuration file with the following command.

```bash
php artisan vendor:publish --tag=zettai-reach-sms-config
```

これにより、`config/zettai-reach-sms.php` ファイルが作成されます。

This will create the `config/zettai-reach-sms.php` file.

### 環境変数の設定 / Environment Variables Configuration

`.env` ファイルに以下の環境変数を追加してください。

Add the following environment variables to your `.env` file.

```env
ZETTAI_REACH_SMS_TOKEN=your-api-token-here
ZETTAI_REACH_SMS_CLIENT_ID=your-client-id-here
ZETTAI_REACH_SMS_TIMEOUT_SECONDS=10
```

- `ZETTAI_REACH_SMS_TOKEN`: アカウント登録時に発行されるアクセスキー（32文字の半角英数字）/ Access key issued during account registration (32 alphanumeric characters)
- `ZETTAI_REACH_SMS_CLIENT_ID`: 契約クライアントID（半角数字）/ Contract client ID (numeric)
- `ZETTAI_REACH_SMS_TIMEOUT_SECONDS`: タイムアウト時間（秒、デフォルト: 10）/ Timeout duration (seconds, default: 10)

### config ファイルの内容 / Configuration File Content

`config/zettai-reach-sms.php` の内容は以下の通りです。

The content of `config/zettai-reach-sms.php` is as follows.

```php
<?php
declare(strict_types=1);

return [
    'token'           => env('ZETTAI_REACH_SMS_TOKEN', ''),
    'client_id'       => env('ZETTAI_REACH_SMS_CLIENT_ID', ''),
    'timeout_seconds' => (int) env('ZETTAI_REACH_SMS_TIMEOUT_SECONDS', 10),
];
```

## 使用方法 / Usage

このライブラリは、静的呼び出しと動的呼び出しの両方をサポートしています。

This library supports both static and dynamic invocation.

### CommonMT 送信 / Send SMS

SMS を送信します。予約送信も可能です。

Send SMS messages. Scheduled sending is also supported.

#### 静的呼び出し / Static Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// 即時送信 / Immediate sending
$response = ZettaiReachSmsClient::send(
    phoneNumber: '09012345678',
    message: 'これはテストメッセージです。',
);

// オプションパラメータを指定した送信 / Send with optional parameters
$response = ZettaiReachSmsClient::send(
    phoneNumber: '09012345678',
    message: 'これはテストメッセージです。',
    carrierId: '101',           // キャリアID / Carrier ID (101: docomo, 103: au, 105: SoftBank, 106: Rakuten Mobile)
    clientTag: 'unique-tag-001', // 送信ステータス確認用のユニークな識別文字列 / Unique identifier for checking send status
    scheduleTime: '2025-12-31 15:00', // 予約送信時間（yyyy-MM-dd HH:mm 形式）/ Scheduled send time (yyyy-MM-dd HH:mm format)
    groupTag: 'campaign-001',    // 予約確認・一括キャンセル用の識別文字列 / Identifier for checking/canceling scheduled messages
);
```

#### 動的呼び出し / Dynamic Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function sendSms(): void
{
    // 即時送信 / Immediate sending
    $response = $this->smsClient->send(
        phoneNumber: '09012345678',
        message: 'これはテストメッセージです。',
    );

    // オプションパラメータを指定した送信 / Send with optional parameters
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

#### レスポンス例 / Response Example

```php
[
    'responseCode' => 0,                    // 0: 成功, 1以上: エラー / 0: Success, 1 or more: Error
    'responseMessage' => 'Success.',        // 応答メッセージ / Response message
    'phoneNumber' => '+819012345678',       // 送信先電話番号（国際電話番号形式）/ Destination phone number (international format)
    'smsMessage' => 'これはテストメッセージです。', // 送信したメッセージ / Sent message
]
```

### CommonMT 予約送信確認 / Check Scheduled SMS

予約送信の状態を確認します。

Check the status of scheduled SMS.

#### 静的呼び出し / Static Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// clientTag で確認 / Check by clientTag
$response = ZettaiReachSmsClient::checkReservation(
    clientTag: 'unique-tag-001',
);

// scheduleTime で確認 / Check by scheduleTime
$response = ZettaiReachSmsClient::checkReservation(
    scheduleTime: '2025-12-31 15:00',
);

// scheduleDate で確認 / Check by scheduleDate
$response = ZettaiReachSmsClient::checkReservation(
    scheduleDate: '20251231',
);

// scheduleTime と groupTag の組み合わせで確認 / Check by scheduleTime and groupTag combination
$response = ZettaiReachSmsClient::checkReservation(
    scheduleTime: '2025-12-31 15:00',
    groupTag: 'campaign-001',
);
```

#### 動的呼び出し / Dynamic Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function checkReservation(): void
{
    // clientTag で確認 / Check by clientTag
    $response = $this->smsClient->checkReservation(
        clientTag: 'unique-tag-001',
    );

    // scheduleDate と groupTag の組み合わせで確認 / Check by scheduleDate and groupTag combination
    $response = $this->smsClient->checkReservation(
        scheduleDate: '20251231',
        groupTag: 'campaign-001',
    );
}
```

#### レスポンス例 / Response Example

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー / 0: Success, 1 or more: Error
    'responseMessage' => 'Success.',
    'count' => 1,               // 予約送信の件数 / Number of scheduled messages
    'status' => [               // 予約送信のステータス情報の配列 / Array of scheduled message status information
        [
            'clientTag' => 'unique-tag-001',
            'phoneNumber' => '+819012345678',
            'smsMessage' => 'これはテストメッセージです。',
            'sendStatus' => 0,  // 0: 送信待ち, 1: 送信中, 2: 送信完了, 3: 送信失敗, 9: キャンセル済み / 0: Waiting, 1: Sending, 2: Sent, 3: Failed, 9: Cancelled
            'scheduleTime' => '2025-12-31 15:00:00',
        ],
    ],
]
```

### CommonMT 予約送信キャンセル / Cancel Scheduled SMS

予約送信をキャンセルします。

Cancel scheduled SMS.

#### 静的呼び出し / Static Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// clientTag でキャンセル / Cancel by clientTag
$response = ZettaiReachSmsClient::cancelReservation(
    clientTag: 'unique-tag-001',
);

// scheduleTime でキャンセル / Cancel by scheduleTime
$response = ZettaiReachSmsClient::cancelReservation(
    scheduleTime: '2025-12-31 15:00',
);

// scheduleDate でキャンセル / Cancel by scheduleDate
$response = ZettaiReachSmsClient::cancelReservation(
    scheduleDate: '20251231',
);

// groupTag でまとめてキャンセル / Cancel by groupTag
$response = ZettaiReachSmsClient::cancelReservation(
    scheduleTime: '2025-12-31 15:00',
    groupTag: 'campaign-001',
);
```

#### 動的呼び出し / Dynamic Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function cancelReservation(): void
{
    // clientTag でキャンセル / Cancel by clientTag
    $response = $this->smsClient->cancelReservation(
        clientTag: 'unique-tag-001',
    );

    // groupTag でまとめてキャンセル / Cancel by groupTag
    $response = $this->smsClient->cancelReservation(
        scheduleDate: '20251231',
        groupTag: 'campaign-001',
    );
}
```

#### レスポンス例 / Response Example

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー / 0: Success, 1 or more: Error
    'responseMessage' => 'Success.',
    'count' => 1,               // キャンセルした予約送信の件数 / Number of cancelled scheduled messages
]
```

### CommonMT 予約送信一括キャンセル / Cancel All Scheduled SMS

指定した日付の予約送信をすべてキャンセルします。

Cancel all scheduled SMS for the specified date.

#### 静的呼び出し / Static Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// 指定日の予約送信をすべてキャンセル / Cancel all scheduled SMS for the specified date
$response = ZettaiReachSmsClient::cancelReservationAll(
    scheduleDate: '20251231', // yyyyMMdd 形式 / yyyyMMdd format
);
```

#### 動的呼び出し / Dynamic Method

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

#### レスポンス例 / Response Example

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー / 0: Success, 1 or more: Error
    'responseMessage' => 'Success.',
    'count' => 5,               // キャンセルした予約送信の件数 / Number of cancelled scheduled messages
]
```

### CommonMT ステータス取得 / Get Status

送信した SMS のステータスを取得します。

Get the status of sent SMS.

#### 静的呼び出し / Static Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

$response = ZettaiReachSmsClient::status(
    clientTag: 'unique-tag-001',
);
```

#### 動的呼び出し / Dynamic Method

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

#### レスポンス例 / Response Example

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー / 0: Success, 1 or more: Error
    'responseMessage' => 'Success.',
    'clientTag' => 'unique-tag-001',
    'phoneNumber' => '+819012345678',
    'smsMessage' => 'これはテストメッセージです。',
    'sendStatus' => 2,          // 0: 送信待ち, 1: 送信中, 2: 送信完了, 3: 送信失敗, 9: キャンセル済み / 0: Waiting, 1: Sending, 2: Sent, 3: Failed, 9: Cancelled
    'carrierStatus' => 0,       // キャリアから返却されるステータスコード / Status code returned from carrier
    'sendTime' => '2025-12-31 15:00:00',
    'receiveTime' => '2025-12-31 15:00:05',
]
```

### ショート URL 登録 / Register Short URL

長い URL をショート URL に変換します。

Convert long URLs to short URLs.

#### 静的呼び出し / Static Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// デフォルトドメインで変換 / Convert with default domain
$response = ZettaiReachSmsClient::shortenUrl(
    longUrl: 'https://example.com/very/long/url/path/to/page',
);

// カスタムドメインで変換 / Convert with custom domain
$response = ZettaiReachSmsClient::shortenUrl(
    longUrl: 'https://example.com/very/long/url/path/to/page',
    domain: 'custom.example.com',
);
```

#### 動的呼び出し / Dynamic Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;

public function __construct(
    private readonly ZettaiReachSmsClientInterface $smsClient,
) {
}

public function createShortUrl(): void
{
    // デフォルトドメインで変換 / Convert with default domain
    $response = $this->smsClient->shortenUrl(
        longUrl: 'https://example.com/very/long/url/path/to/page',
    );

    // カスタムドメインで変換 / Convert with custom domain
    $response = $this->smsClient->shortenUrl(
        longUrl: 'https://example.com/very/long/url/path/to/page',
        domain: 'custom.example.com',
    );
}
```

#### レスポンス例 / Response Example

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー / 0: Success, 1 or more: Error
    'responseMessage' => 'Success.',
    'shortUrl' => 'https://short.url/abc123', // 生成されたショート URL / Generated short URL
]
```

### 登録済み定型文取得 / Get Templates

アカウントに登録されている定型文の一覧を取得します。

Get a list of templates registered to the account.

#### 静的呼び出し / Static Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

$response = ZettaiReachSmsClient::template();
```

#### 動的呼び出し / Dynamic Method

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

#### レスポンス例 / Response Example

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー / 0: Success, 1 or more: Error
    'responseMessage' => 'Success.',
    'count' => 2,               // 登録済み定型文の件数 / Number of registered templates
    'templates' => [            // 登録済み定型文の配列 / Array of registered templates
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

### 電話番号クリーニング / Phone Number Cleaning

電話番号の妥当性を検証し、キャリア情報を取得します。

Validate phone numbers and retrieve carrier information.

#### 静的呼び出し / Static Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

// 日本国内形式で指定 / Specify in Japanese domestic format
$response = ZettaiReachSmsClient::numberCleaning(
    phoneNumber: '09012345678',
);

// 国際電話番号形式で指定 / Specify in international format
$response = ZettaiReachSmsClient::numberCleaning(
    phoneNumber: '+819012345678',
);
```

#### 動的呼び出し / Dynamic Method

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

#### レスポンス例 / Response Example

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー / 0: Success, 1 or more: Error
    'responseMessage' => 'Success.',
    'phoneNumber' => '+819012345678',  // クリーニング後の電話番号（国際電話番号形式）/ Cleaned phone number (international format)
    'carrierId' => '101',       // 101: docomo, 103: au, 105: SoftBank, 106: 楽天モバイル / 101: docomo, 103: au, 105: SoftBank, 106: Rakuten Mobile
    'status' => 'valid',        // valid: 有効, invalid: 無効, unknown: 判定不可 / valid: Valid, invalid: Invalid, unknown: Unknown
]
```

### 通数集計 / Count Statistics

指定期間内の送信成功件数を集計します。

Aggregate the number of successful sends within the specified period.

#### 静的呼び出し / Static Method

```php
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;

$response = ZettaiReachSmsClient::separatedSuccessCount(
    startDate: '20251201',  // yyyyMMdd 形式 / yyyyMMdd format
    endDate: '20251231',    // yyyyMMdd 形式 / yyyyMMdd format
);
```

#### 動的呼び出し / Dynamic Method

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

#### レスポンス例 / Response Example

```php
[
    'responseCode' => 0,        // 0: 成功, 1以上: エラー / 0: Success, 1 or more: Error
    'responseMessage' => 'Success.',
    'totalCount' => 1500,       // 指定期間内の総送信成功件数 / Total number of successful sends within the specified period
    'separatedCount' => [       // キャリア別の送信成功件数の配列 / Array of successful sends by carrier
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
            'carrierId' => '106',   // 楽天モバイル / Rakuten Mobile
            'carrierName' => 'Rakuten Mobile',
            'count' => 100,
        ],
    ],
]
```

## ライセンス / License

このプロジェクトは MIT ライセンスの下で公開されています。詳細は [LICENSE](LICENSE) ファイルをご覧ください。

This project is published under the MIT License. See the [LICENSE](LICENSE) file for details.
