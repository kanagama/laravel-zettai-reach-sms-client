---
applyTo: src/UseCase/ShortenUrl/**/*.php
---

# ショート URL 登録

## API URL

[POST] https://sms-api.aossms.com/p1/api/shortenurl.json

## REQUEST BODY

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| token(required) | string(32) | アカウント登録時に発行されるアクセスキーを指定します。トークンの値につきましては、管理画面のアカウント情報をご確認ください。半角英数字 |
| clientId(required) | string | 契約クライアント ID を指定します。割り当てられている契約クライアント ID につきましては、管理画面のクライアント情報をご確認ください。半角数字 |
| longUrl(required) | string(1 - 2048) | ショート URL に変換するオリジナル URL を指定します。 |
| domain | string | ショート URL に変換する際のドメインを指定します。指定しない場合はデフォルトドメインが使用されます。 |

## RESPONSE

200 ※responseCode:0 が返却されていない場合、リクエストの受付には失敗しています。

| responseCode | responseMessage | 説明 |
| ---- | ---- | ---- |
| 0 | Success. | リクエストが成功しました。 |
| 100 | Required {項目名}. | {項目名}の項目が不足しています。 |
| 110 | Invalid {項目名}. | {項目名}の項目が不正です。 |
| 120 | {項目名} too long. | {項目名}の長さが上限を超過しています。 |
| 500 | System error. | 上記で定義外のエラーが発生しています。 |


## Response Schema

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| responseCode(required) | integer [ 1 .. 3 ] | 応答コードです。正常時は 0 を返します。1 以上の場合はエラーになります。 |
| responseMessage(required) | string | 応答結果を示すメッセージです。 |
| shortUrl(required) | string | 生成されたショート URL です。 |
