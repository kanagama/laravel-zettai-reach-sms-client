---
applyTo: src/UseCase/CheckReservation/**/*.php
---

# CommonMT 予約送信確認

## API URL

[GET] https://sms-api.aossms.com/p5/api/checkreservation.json

## QUERY PARAMETERS

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| token(required) | string(32) | アカウント登録時に発行されるアクセスキーを指定します。トークンの値につきましては、管理画面のアカウント情報をご確認ください。半角英数字 |
| clientId(required) | string | 契約クライアント ID を指定します。割り当てられている契約クライアント ID につきましては、管理画面のクライアント情報をご確認ください。 |
| smsCode(required) | string(5 or 6) | 送信元 SMS コードを指定します。割り当てられている SMS コードにつきましては、管理画面のクライアント情報をご確認ください。 |
| clientTag | string(1 - 200) | 送信ステータス確認用の任意の識別文字列を指定します。※本項目または scheduleTime, scheduleDate のいずれかが必須。※優先度は clientTag > scheduleTime > scheduleDate になります。※本項目を指定した場合、指定文字列を保持する SMS のステータスを返却します。本項目を指定しない場合、SMS 送信日のデータを検索して返却します。 |
| scheduleTime | string <yyyy-MM-dd HH:mm> | 予約送信時間を文字列で指定します。フォーマットは「YYYY-MM-dd HH:mm」となります。※本項目または clientTag, scheduleDate のいずれかが必須。※優先度は clientTag > scheduleTime > scheduleDate になります。groupTagも指定されている場合は組み合わせ条件になります。 |
| scheduleDate | string <yyyyMMdd> | 予約送信日を半角数字で指定します。※本項目または clientTag, scheduleTime のいずれかが必須。※優先度は clientTag > scheduleTime > scheduleDate になります。groupTagも指定されている場合は組み合わせ条件になります。 |
| groupTag | string(1 - 200) | 予約リクエスト時に指定した任意識別文字列を指定します。 |

## RESPONSE

200 ※responseCode:0 が返却されていない場合、リクエストの受付には失敗しています。

| responseCode | responseMessage | 説明 |
| ---- | ---- | ---- |
| 0 | Success. | リクエストが成功しました。 |
| 100 | Required {項目名}. | {項目名}の項目が不足しています。 |
| 110 | Invalid {項目名}. | {項目名}の項目が不正です。 |
| 120 | {項目名} too long. | {項目名}の長さが上限を超過しています。 |
| 130 | Already send. | 確認対象のクライアントタグは既に送信されています。 |
| 140 | Past {項目名}. | {項目名}は過去日時です。 |
| 500 | System error. | 上記で定義外のエラーが発生しました。 |


## Response Schema

| パラメータ名 | 型 | 説明 |
| ---- | ---- | ---- |
| responseCode(required) | integer [ 1 .. 3 ] | 応答コードです。正常時は 0 を返します。1 以上の場合はエラーになります。 |
| responseMessage(required) | string | 応答結果を示すメッセージです。 |
| count(required) | integer | 予約送信の件数です。 |
| status(required) | array | 予約送信のステータス情報の配列です。 |
