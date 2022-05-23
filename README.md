# -Reversi_App_eg1

# はじめに
自己学習の一環で作ることにしたリバーシアプリのgit

# 目的
純粋な PHP でプログラムを実装することで、PHP とプログラミングそのものの深い理解に繋げる

# プログラムの最低要件
今回の制作で必要な最低限の要件は以下の通り。

今後作業を進めながら細かい要件は決めていく。 

・PHP によるコンソールプログラム
 
・最低限リバーシとして遊べること

・人 vs 人

# 開発環境
dockerでphpのコンテナを作成し、そのコンテナ内で、動くリバーシを作る。
純粋なPHPプログラムにするためにappachなどは用いない。

```
docker pull php
docker run -v /lib/reversi:/lib/reversi --name reversi-app php /bin/bash
docker start reversi-app
docker exec -it reversi-app /bin/bash
```

# 日数、リバーシのルール

リバーシのルールは、
・8×8マス

・自分の石が隣り合っている相手の石をはさむところにしか置けない。(置けなかったら勝手にスキップ)

・自分の石で相手の石を挟むと自分の色に変わる。(縦、横、斜め)

・勝利条件はゲームが終わった時点で。自分の石の数が相手の石の数より多いと勝利。


・ゲームの進行は、スタートの仕方を決めて(コンソールゲームってどうやって始めるんだ…質問に対して特定の言葉を決めるとか？)、

あと、コンソール画面で選択するというイメージがまだついていないが最初に始めた人から、01もしくは○●の表示が出て、おける場所を選択できるようにする(コンソールゲームで選択ってどうやるんだろう、vimみたいになるのか？)。

スタートは中央の2×2マス。PLAYER1、PLAYER2ぐらいの表記は出るようにして、順番にやる(とりあえず、●がスタートでやってみる)。

石がおけなくなったら、石の数が出て終了。またスタートするとできる

※石のデザイン表記どうなるかわからないが最悪0、1表記でやってみる。

日数は早く終われば、それだけ良いということにして、残り1か月半で確実に取れそうな、4営業日(8時間×4=32時間)を目標にする。

なんとなく、感覚つかめれば半分で行けそうな気もする？
