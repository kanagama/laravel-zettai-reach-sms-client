# 自動テスト用のコンテナを作成する
test-build:
	docker-compose -f compose-test.yml build --no-cache --progress=plain
# テストを実行する
test:
	docker-compose -f compose-test.yml up
# 開発用のコンテナを作成する
development-build:
	docker-compose -f compose.yml build --no-cache --progress=plain
# 開発用のコンテナを起動する
development:
	docker-compose -f compose.yml up
# 開発用コンテナに入る
container:
	docker exec -it php82_laravel_zettai_reach_sms_client /bin/bash
# git fetch
fetch:
	GIT_SSH_COMMAND="ssh -i ~/.ssh/kanagama" git fetch origin
# git push {指定ブランチ}
push:
	GIT_SSH_COMMAND="ssh -i ~/.ssh/kanagama" git push origin ${branch}
