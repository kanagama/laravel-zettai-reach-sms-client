---
applyTo: src/UseCase/NumberCleaning/**/*.php
---

# CommonMT 電話番号クリーニング

## API URL

[POST] https://sms-api.aossms.com/p5/api/numbercleaning.json

## REQUEST BODY

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| token(required) | string(32) | アカウント登録時に発行されるアクセスキーを指定します。トークンの値につきましては、管理画面のアカウント情報をご確認ください。半角英数字 |
| clientId(required) | string | 契約クライアント ID を指定します。割り当てられている契約クライアント ID につきましては、管理画面のクライアント情報をご確認ください。半角数字 |
| phoneNumber(required) | string | クリーニング対象の電話番号を指定します。日本国内形式(070xxxxxxxx/080xxxxxxxx/090xxxxxxxx)、国際電話番号形式のどちらも指定することが可能です。※国際電話番号形式については『別記事項・国際電話番号形式について』をご参照ください。 |

## RESPONSE

200 ※responseCode:0 が返却されていない場合、リクエストの受付には失敗しています。

| responseCode | responseMessage | 説明 |
| ---- | ---- | ---- |
| 0 | Success. | リクエストが成功しました。 |
| 100 | Required {項目名}. | {項目名}の項目が不足しています。 |
| 110 | Invalid {項目名}. | {項目名}の項目の内容が不正です。 |
| 120 | {項目名} too long. | {項目名}の長さが上限を超過しています。 |
| 500 | System error. | 上記で定義外のエラーが発生しました。 |


## Response Schema

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| responseCode(required) | integer [ 1 .. 3 ] | 応答コードです。正常時は 0 を返します。1 以上の場合はエラーになります。 |
| responseMessage(required) | string | 応答結果を示すメッセージです。 |
| phoneNumber | string^\+81(([26789]0[0-9]{8}$)|(20[0-9]{11}$)) | クリーニング後の電話番号です。国際電話番号形式で返却されます。※国際電話番号形式については『別記事項・国際電話番号形式について』をご参照ください。 |
| carrierId | string(Enum: "101" "103" "105" "106") | キャリア ID です。101: docomo, 103: au, 105: SoftBank, 106: 楽天モバイル |
| status | string(Enum: "valid" "invalid" "unknown") | 電話番号のステータスです。valid: 有効, invalid: 無効, unknown: 判定不可 |
