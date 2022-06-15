#　表示はおそらくこれをベースに変えていく。view側　むしろコントローラー側を考える必要がある→分ける処理を考えるかどうか
#　普通に関数使えばいいんじゃね？
echo "+――――――――+\n|　　　　　　　　|\n|　　　　　　　　|\n|　　　　　　　　|\n|　　　●○　 　　|\n|　　　○●　 　　|\n|　　　　　　　　|\n|　　　　　　　　|\n|　　　　　　　　|\n+――――――――+";

#　fget勉強用　これを使って、プレイヤーに行動させる
$w = fgets(STDIN);
echo $w;

echo fgets(STDIN);


#　そうかクラスの概念が割と曖昧なんだよな。
# $obj = new クラス名();
# $obj->クラス内のオブジェクト名();
#　みたいな表記に慣れない……あと確かselfが、クラス自身を示すんだよな。

# 座標に対して置くという概念をどうするか。何を置くとif文くみやすいんだ
#　フィールド作成
#　Rのmatrixやtableみたいな関数がないか模索　扱うの面倒くさかったので配列ではやりたくない。
#　初期値0(空でもよいかも？)配列に1,2を代入していく形で石を置いていく。置ける場所を探すif文はあとで考える。数学！！
for ($y = 0; $y < 8; $y++) { for ($x=0; $x < 8; $x++) { $field[$x][$y]=0; } } #echo $field; echoやprint文は一度文字列に直すため、配列の出力ではエラーが出る。print_rかvar_dumpを用いる var_dump($field); #ステージ初期値 $field[3][3]=1; $field[4][4]=1; $field[3][4]=-1; $field[4][3]=-1; #石置くチェック→関数にするやつ #例えば、黒石か白石かで、探すものが変わる $turn=1; # 既に石が置いてあるのを候補から除く if ($field[$x][$y]==1 | $field[$x][$y]==-1) { return false; } # 隣に敵の石があれば、候補にする if ( #上下を探す。 $field[$x][$y - 1]==-1 | $field[$x][$y + 1]==-1 | #左右を探す。 $field[$x - 1][$y]==-1 | $field[$x + 1][$y]==-1 | #斜めを探す。 $field[$x - 1][$y - 1]==-1 | $field[$x - 1][$y + 1]==-1 | $field[$x + 1][$y - 1]==-1 | $field[$x + 1][$y + 1]==-1 ) { return true; } # 挟む石がなければ、候補から除く # マス数少なければ、$field[$x][$y-1]==1 |$field[$x][$y+1]==1 ……　の方法でも出来そうだけど…… $this->interleaveStone = self::_getInterleaveStone($y, $x, $myField, $setSideEnemyStoneField);
  if (count($this->interleaveStone) === 0) {
  return false;
  }
  return true



  
  $player_W = 1;
$player_B = -1;

for ($turn=1 ; $turn<40 ; $turn++){
  if($turn % 2 == 1){
    $player = $player_W;
  }
  else{
    $player = $player_B;
  }
  print($player);
}

$i = 1;
while ($i <= 10) {
    echo $i++;  /* 出力される値は、足される前の
                    $iの値です。
                    (後置加算) */
}

$a = 5;
$b = 100;
if($a === 1 || $a === 2 || $a === 3){
  echo $a;
}else{
  echo $b;
}