---
applyTo: src/UseCase/Status/**/*.php
---

# CommonMT ステータス取得

## API URL

[GET] https://sms-api.aossms.com/p5/api/status.json

## QUERY PARAMETERS

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| token(required) | string(32) | アカウント登録時に発行されるアクセスキーを指定します。トークンの値につきましては、管理画面のアカウント情報をご確認ください。半角英数字 |
| clientId(required) | string | 契約クライアント ID を指定します。割り当てられている契約クライアント ID につきましては、管理画面のクライアント情報をご確認ください。半角数字 |
| smsCode(required) | string(5 or 6) | 送信元 SMS コードを指定します。割り当てられている SMS コードにつきましては、管理画面のクライアント情報をご確認ください。 |
| clientTag(required) | string(1 - 200) | 送信ステータス確認用の任意の識別文字列を指定します。SMS送信時に指定したクライアントタグを指定してください。 |

## RESPONSE

200 ※responseCode:0 が返却されていない場合、リクエストの受付には失敗しています。

| responseCode | responseMessage | 説明 |
| ---- | ---- | ---- |
| 0 | Success. | リクエストが成功しました。 |
| 100 | Required {項目名}. | {項目名}の項目が不足しています。 |
| 110 | Invalid {項目名}. | {項目名}の項目が不正です。 |
| 120 | {項目名} too long. | {項目名}の長さが上限を超過しています。 |
| 200 | No data. | 指定されたクライアントタグに該当するデータが見つかりません。 |
| 500 | System error. | 上記で定義外のエラーが発生しました。 |


## Response Schema

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| responseCode(required) | integer [ 1 .. 3 ] | 応答コードです。正常時は 0 を返します。1 以上の場合はエラーになります。 |
| responseMessage(required) | string | 応答結果を示すメッセージです。 |
| clientTag(required) | string | リクエスト時に指定したクライアントタグです。 |
| phoneNumber(required) | string^\+81(([26789]0[0-9]{8}$)|(20[0-9]{11}$)) | 送信先電話番号です。国際電話番号形式で返却されます。※国際電話番号形式については『別記事項・国際電話番号形式について』をご参照ください。 |
| smsMessage(required) | string [ 1 - 660 ] | 送信時に指定した message 項目の内容です。 |
| sendStatus(required) | integer | 送信ステータスです。0:送信待ち、1:送信中、2:送信完了、3:送信失敗、9:キャンセル済み |
| carrierStatus | integer | キャリアステータスです。キャリアから返却されるステータスコードです。 |
| sendTime | string <yyyy-MM-dd HH:mm:ss> | 送信日時です。 |
| receiveTime | string <yyyy-MM-dd HH:mm:ss> | キャリアからの受信確認日時です。 |
