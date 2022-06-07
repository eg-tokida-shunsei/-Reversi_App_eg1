<?php

#課題点　　フラグをどうつけるか　　挟める石をどうやって探すか。。



#作戦2　一次元配列で制作。

#空欄0の盤面を作成。　repeatみたいなのないのかな……繰り返しでfor文いちいち書くのあほらしいんやが
for ($a = 0; $a < 65; $a++) {
  $field[$a] = 0;
}
#初期値設定
$field[27] = $field[36] = 1;
$field[28] = $field[35] = -1;

#表示
$a = 0;

for ($y = 0; $y < 8; $y++) {
  for ($x = 0; $x < 8; $x++) {
    $field_sql[$x][$y] = $field[$a];
    $a = $a + 1;
  }
}

$field_view = str_replace(1, "○", $field);
$field_view = str_replace(-1, "●", $field_view);
$field_view = str_replace(0, "□", $field_view);
echo $field_view;

#if文

#例えば、以下のような関数で置く場所をしていしてもらう　これだとあまり親切でないので、行と列の情報からpush出来るようにする→動かせたら。
$push= fgets(STDIN);
echo $push;

#で、拾った値で処理をしていく。
#配列で取り出し、オセロのルールとして問題ないかチェックしていく。

#今回は白ベースにしているけど白と黒でパラメーター分けないといけない。
#終了したら、player_Wとplayer_Bを変える。例えば、playerというのを作って、処理が終わったら変える。forでターン数を数えて、奇数はplayer_W、偶数はplayer_Bにする。みたいな処理

$player_W = 1;
$player_B = -1;


#1.隣に石がないときに置けない。



#2.隣が同じ石の時に置けない。

#if($field[$push+1] = $player_W | $field[$push-1] = $player_W | $field[$push-8] = $player_W | $field[$push+8] = $player_W)
#{
#  print("error");
#}


#3.既に置いてある場所には置けない。

if($field[$push] = $player_W)
{
  print("error");
}

#4.隣が別の石であるときにはおけるが、置いた石の列の端が同じ石でなければならない。

#置けない場所で考えると後半エラーが出そう。置ける場所で考えよう→置けるということは隣が別の色。ここの条件で、1と2はクリア

if($field[$push+1] = -1 | $field[$push-1] = -1 | $field[$push-8] = -1 | $field[$push+8] = $player_W | $field[$push-9] = $player_W | $field[$push+9] = $player_W | $field[$push-7] = $player_W | $field[$push+7] = $player_W)
{
#4の処理はここでカバーする。そうかオセロって置いたらどの位置のも取れるじゃん(2回目)

#配列の出し方。1,2,3,4,5,6,7,8,57,58,59,61,62,63,64,9,17,25,33,41,49,16,24,32,40,48,56を踏んだところまでの配列をだす。
#セットは[$push-1~-7,$push,$push+1~+7],[$push-7,-14...-49,$push,$push+7,+14...+49][[$push-9,-18...-63,$push,$push+9,+18...+63]で探す。


}
else
{
  print("error");
}

#基本の動き作り終えたらメソッドにして簡略化して、組み立てる、