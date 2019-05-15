# KIGA-NAKSO  

## 📌概要  
飢餓をなくすためのプロジェクト  
「世界から飢餓をなくすことに貢献」したい  
「自炊している一人暮らしの下宿生」向けの  
「KIGA NAKSO」というプロダクトは  
「無料で入手できるスマホアプリ（サービス）」です。  
これは「食材の購入や調理方法のレコメンド」ができ、  
「他の献立アプリやサービス」とは違って、  
「無駄に廃棄する食材を最小限にする機能」が備わっている。  

## 🔧install & build

```shell
$ git clone git@github.com:Raccoo/KIGA-NAKSO.git # gitからダウンロード

```

Vagrantfileがあるファイル上で  

```shell
$ vagrant up --provision
```
でバーってなるので終わったら、127.0.0.1:8080/KIGA-NAKSOにアクセスしてページが表示されたら完了  
失敗したらしらん。  

```shell
$ vagrant halt
```

でシャットダウンできます  

```shell
$ vagrant up
```
2回目以降の起動はこのコマンドで起動できます  
シャットダウンは上のままでOK  

vagrant upが終わった状態で  
```shell
$ vagrant ssh
```
その後、
```shell
$ sudo install -y phpmyadmin
```
dpkgなんちゃらって出たらそのコマンド実行して、また上のコマンド実行してください  
インストールが進んでいくと紫いろの画面でパスワードを聞かれるので好きなパスワードを入力  
パスワード、忘れるな絶対。忘れたら復旧の方法知りません。教えて下さい  
でパスワードを再確認されるのでもう1回入力する  
次の画面ではapache2のカーソル合わせてスペースキー入力後エンター入力でまたインストールが進んできます  
そして yes or noの画面が出てくるのでyesを選択  
パスワード2回聞かれるんで入力。  　
多分これで入れます。  
http://127.0.0.1:8080/KIGA-NAKSO/phpmyadmin  
ログインはユーザ名のroot、パスワードは設定したやつを入力してください  
ここまで長かったけど実際動くか知りません。頑張れ。Good Luck

