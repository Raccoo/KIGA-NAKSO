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

