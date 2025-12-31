---
applyTo: src/UseCase/SeparatedSuccessCount/**/*.php
---

# CommonMT 通数集計

## API URL

[GET] https://sms-api.aossms.com/p5/api/separatedsuccesscount.json

## QUERY PARAMETERS

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| token(required) | string(32) | アカウント登録時に発行されるアクセスキーを指定します。トークンの値につきましては、管理画面のアカウント情報をご確認ください。半角英数字 |
| clientId(required) | string | 契約クライアント ID を指定します。割り当てられている契約クライアント ID につきましては、管理画面のクライアント情報をご確認ください。半角数字 |
| smsCode(required) | string(5 or 6) | 送信元 SMS コードを指定します。割り当てられている SMS コードにつきましては、管理画面のクライアント情報をご確認ください。 |
| startDate(required) | string <yyyyMMdd> | 集計開始日を半角数字で指定します。 |
| endDate(required) | string <yyyyMMdd> | 集計終了日を半角数字で指定します。 |

## RESPONSE

200 ※responseCode:0 が返却されていない場合、リクエストの受付には失敗しています。

| responseCode | responseMessage | 説明 |
| ---- | ---- | ---- |
| 0 | Success. | リクエストが成功しました。 |
| 100 | Required {項目名}. | {項目名}の項目が不足しています。 |
| 110 | Invalid {項目名}. | {項目名}の項目が不正です。 |
| 120 | {項目名} too long. | {項目名}の長さが上限を超過しています。 |
| 130 | Invalid date range. | 日付範囲が不正です。 |
| 500 | System error. | 上記で定義外のエラーが発生しました。 |


## Response Schema

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| responseCode(required) | integer [ 1 .. 3 ] | 応答コードです。正常時は 0 を返します。1 以上の場合はエラーになります。 |
| responseMessage(required) | string | 応答結果を示すメッセージです。 |
| totalCount(required) | integer | 指定期間内の総送信成功件数です。 |
| separatedCount(required) | array | キャリア別の送信成功件数の配列です。 |
