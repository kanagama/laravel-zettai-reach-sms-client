---
applyTo: src/UseCase/Send/**/*.php
---

# CommonMT 送信

## API URL

[POST] https://sms-api.aossms.com/p5/api/mt.json

## REQUEST BODY

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| token(required) | string(32) | アカウント登録時に発行されるアクセスキーを指定します。トークンの値につきましては、管理画面のアカウント情報をご確認ください。 |
| clientId(required) | string | 契約クライアント ID を指定します。割り当てられている契約クライアント ID につきましては、管理画面のクライアント情報をご確認ください。半角数字 |
| smsCode(required) | string(5 or 6) | 送信元 SMS コードを指定します。割り当てられている SMS コードにつきましては、管理画面のクライアント情報をご確認ください。 |
| message(required) | string(1 - 660) | 送信元 SMS コードを指定します。割り当てられている SMS コードにつきましては、管理画面のクライアント情報をご確認ください。 |
| phoneNumber(required) | string^(\+81|0)(([26789]0[1-9][0-9]{7}$)|(20[1-9][0-9]{10}$)) | 送信先電話番号を指定します。日本国内形式(070xxxxxxxx/080xxxxxxxx/090xxxxxxxx)、国際電話番号形式のどちらも指定することが可能です。※国際電話番号形式については『別記事項・国際電話番号形式について』をご参照ください。 |
| carrierId | string(Enum: "101" "103" "105" "106") | キャリア ID を指定します。指定しない場合は本サービスにて電話番号より送信先キャリアを自動判定します。 |
| clientTag | string(1 - 200) | 送信ステータス確認用の任意の識別文字列を指定します。必ずユニークな値を指定してください。値の重複があるとエラーになります。 |
| scheduleTime | string <yyyy-MM-dd HH:mm> | 予約送信時間を指定します。 |
| groupTag | string(1 - 200) | 予約確認・一括キャンセル用の任意識別文字列を指定します。 |

## RESPONSE

200 ※responseCode:0 が返却されていない場合、リクエストの受付には失敗しています。

| responseCode | responseMessage | 説明 |
| ---- | ---- | ---- |
| 0 | Success | リクエストの受付が成功しました。 |
| 100 | Required {項目名} | {項目名}の項目が不足しています。 |
| 110 | nvalid {項目名} | {項目名}の項目の内容が不正です。 |
| 120 | {項目名} too long. | {項目名}の長さが上限を超過しています。 |
| 300 | Exceed sending count. | 契約プランで定められた送信可能な件数の上限を超過しています。 |
| 400 | Duplicate client tag. | クライアントタグが以前にリクエストした際のクライアントタグと重複しています。 |
| 500 | System error. | 上記で定義外のエラーが発生しています。 |


## Response Schema

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| responseCode(required) | integer [ 1 .. 3 ] | 応答コードです。正常時は 0 を返します。1 以上の場合はエラーになります。 |
| responseMessage(required) | string | 応答結果を示すメッセージです。 |
| phoneNumber(required) | string^\+81(([26789]0[0-9]{8}$)|(20[0-9]{11}$)) | リクエスト時に指定した送信先電話番号です。国際電話番号形式で返却されます。※国際電話番号形式については『別記事項・国際電話番号形式について』をご参照ください。 |
| smsMessage(required) | string [ 1 - 660 ]  | 送信時に指定した message 項目の内容です。 |
