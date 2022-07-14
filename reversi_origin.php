<?php

#ここに完成したプログラムをまとめる

#ゲーム開始の流れ

print("  |GAME START|  \n  -Enterを押してください-  \n");
echo fgets(STDIN);
print("1番目のプレイヤー。あなたはplayer_Wです\n-Enterを押してください-\n");
echo fgets(STDIN);
print("2番目のプレイヤー。あなたはplayer_Bです\n-Enterを押してください-\n");
echo fgets(STDIN);
print("ゲームを開始します。準備はよろしいですか\n[y/n]?\n");
echo fgets(STDIN);
print("準備に関係なく、ゲームを開始します\n\n");

#ゲーム



#初期値設定
$field = array_fill(1, 64, 0);
$field[28] = $field[37] = 1;
$field[29] = $field[36] = -1;
$player_W = 1;
$player_B = -1;
$field_check = $field;



#置換用の表

for ($i=1; $i<=64; ++$i) {
  $field_rep[] =$i;
}

$b = 0;

for ($x = 1; $x < 9; $x++) {
  for ($y = 1; $y < 9; $y++) {
    $replace[$x][$y] = $field_rep[$b];
    $b = $b + 1;
  }
}

#石ひっくり返すプログラム

function reversi_stone($field, $number, $player, $push, $octas)
{
  $field_log = $field;
  for ($X = 1; $X < 8; $X++) {


    if (
      $number === 1 || $number === 2 || $number === 3 || $number === 4 || $number === 5 || $number === 6 || $number === 7 || $number === 8 || $number === 57 || $number === 58
      || $number === 59 || $number === 61 || $number === 62 || $number === 63 || $number === 64 || $number === 9 || $number === 17 || $number === 25 || $number === 33 || $number === 41
      || $number === 49 || $number === 16 || $number === 24 || $number === 32 || $number === 40 || $number === 48 || $number === 56
    ) {
      if ($X === 7) {
        if ($field[$number] + $player === 0) {
          $field[$number] = $player;
          $number_array[] = $number;

          #一番端に自分と同じ石がなかった時、リセット

          foreach ($number_array as $value) {
            $field[$value] = $field_log[$value];
          }
          break;
        } else {
          if ($field[$number] === $player) {
            #一番端が自分の石ならひっくり返す(今までひっくり返してきた石を元に戻さない)
            $field[$push] = $player;
            break;
          } else {
            #違った場合リセット。
            $number_array[] = $number;
            foreach ($number_array as $value) {
              $field[$value] = $field_log[$value];
            }
            break;
          }
        }
      } else {
        if ($field[$number] === $player) {
          #一番端が自分の石ならひっくり返す(今までひっくり返してきた石を元に戻さない)
          $field[$push] = $player;
          break;
        } else {
          #一番端が自分の石以外ならリセット
          $number_array[] = $number;
          foreach ($number_array as $value) {
            $field[$value] = $field_log[$value];
          }
          break;
        }
      }

    } else {
      if ($X === 1) {
        #探索する場所を決定し八方位探索する。
        $number = $push + $octas;
        if ($number <= 0 || $number >= 65) {
          break;
        } else {
          if ($field[$number] + $player === 0) {
            #石をひっくり返し、ひっくり返した場所の保存
            $field[$number] = $player;
            $number_array = [$number];
            $number = $number + $octas;
            if ($number <= 0 || $number >= 65) {
              break;
            }
          } else {
            if ($field[$number] === $player) {
              break;
            } else {
              #違ったときリセット
              $number_array[] = $number;
              foreach ($number_array as $value) {
                $field[$value] = $field_log[$value];
              }
              break;
            }
          }
        }
      } else {
        #1以外の処理
        if ($field[$number] + $player === 0) {
          #石をひっくり返し、ひっくり返した場所の保存
          $field[$number] = $player;
          $number_array[] = $number;
          $number = $number + $octas;
          if ($number <= 0 || $number >= 65) {
            break;
          }
        } else {
          #一番端が自分の石ならひっくり返す(今までひっくり返してきた石を元に戻さない)
          if ($field[$number] === $player) {
            $field[$push] = $player;
            break;
          } else {
            #違ったときリセット
            $number_array[] = $number;
            foreach ($number_array as $value) {
              $field[$value] = $field_log[$value];
            }
            break;
          }
        }
      }
    }
  }
}

#石表示プログラム

function reversi_view($field){
foreach ($field as $key => $value) {
  $value = "$value";
}

$field_view = str_replace("-1", "○", $field);
$field_view = str_replace("1", "●", $field_view);
$field_view = str_replace("0", "□", $field_view);

echo " " . "|" . "1" . "|" . "2" . "|" . "3" . "|" . "4" . "|" . "5" . "|" . "6" . "|" . "7" . "|" . "8" . "|" . " " . "\n";
echo "1" . "|" . $field_view[1] . "|" . $field_view[2] . "|" . $field_view[3] . "|" . $field_view[4] . "|" . $field_view[5] . "|" . $field_view[6] . "|" . $field_view[7] . "|" . $field_view[8] . "|" . "1" . "\n";
echo "2" . "|" . $field_view[9] . "|" . $field_view[10] . "|" . $field_view[11] . "|" . $field_view[12] . "|" . $field_view[13] . "|" . $field_view[14] . "|" . $field_view[15] . "|" . $field_view[16] . "|" . "2" . "\n";
echo "3" . "|" . $field_view[17] . "|" . $field_view[18] . "|" . $field_view[19] . "|" . $field_view[20] . "|" . $field_view[21] . "|" . $field_view[22] . "|" . $field_view[23] . "|" . $field_view[24] . "|" . "3" . "\n";
echo "4" . "|" . $field_view[25] . "|" . $field_view[26] . "|" . $field_view[27] . "|" . $field_view[28] . "|" . $field_view[29] . "|" . $field_view[30] . "|" . $field_view[31] . "|" . $field_view[32] . "|" . "4" . "\n";
echo "5" . "|" . $field_view[33] . "|" . $field_view[34] . "|" . $field_view[35] . "|" . $field_view[36] . "|" . $field_view[37] . "|" . $field_view[38] . "|" . $field_view[39] . "|" . $field_view[40] . "|" . "5" . "\n";
echo "6" . "|" . $field_view[41] . "|" . $field_view[42] . "|" . $field_view[43] . "|" . $field_view[44] . "|" . $field_view[45] . "|" . $field_view[46] . "|" . $field_view[47] . "|" . $field_view[48] . "|" . "6" . "\n";
echo "7" . "|" . $field_view[49] . "|" . $field_view[50] . "|" . $field_view[51] . "|" . $field_view[52] . "|" . $field_view[53] . "|" . $field_view[54] . "|" . $field_view[55] . "|" . $field_view[56] . "|" . "7" . "\n";
echo "8" . "|" . $field_view[57] . "|" . $field_view[58] . "|" . $field_view[59] . "|" . $field_view[60] . "|" . $field_view[61] . "|" . $field_view[62] . "|" . $field_view[63] . "|" . $field_view[64] . "|" . "8" . "\n";
echo " " . "|" . "1" . "|" . "2" . "|" . "3" . "|" . "4" . "|" . "5" . "|" . "6" . "|" . "7" . "|" . "8" . "|" . " " . "\n";
}

#プレイヤー変換と回数処理
#勝利条件

for ($turn=1 ; $turn<150 ; $turn++){
  if($turn % 2 == 1){
    $player = $player_W;
    $player_name = 'player_W';
  }
  else{
    $player = $player_B;
    $player_name = 'player_B';
  }

if(in_array(0, $field)){
  //ゲームをするプログラム

reversi_view($field);
echo "\n" . $player_name . "\n";
print("あなたのターンです\n置きたい場所の縦列の番号と横列の番号を入力してください\n\n※石をひっくり返せない場所に置くともう一度選択する必要が出てきます。パスをする場合、縦列で0か横列で0を入力してください\n");

//数字だけしかないように入力制限をする。パス機能を付ける
print("縦列：");
$col_f = fgets(STDIN);
$col = intval($col_f);

print("横列：");
$row_f = fgets(STDIN);
$row = intval($row_f);

if($col === 0 || $row ===0){
  break;
}

$push = $replace[$row][$col];

var_dump($push);

#置いた石を8方位を探してひっくり返す作業
$octas_array = [-9, -8, -7, -1, 1, 7, 8, 9];

if($field[$push] === $player)
{
}
else{
foreach ($octas_array as $octas) {
  $number = 0;
  reversi_stone($field, $number, $player, $push, $octas);
  echo $field[28];
  echo "■";
  echo $field[36];
  echo "■";
  echo $field[44];
  echo "■";
}
}


if($field_check === $field){
  $turn = $turn-1;
}

$field_check = $field;


}
else{
  $W_result = array_keys($field, 1);
  $B_result = array_keys($field, -1);

  if(count($W_result) > count($B_result)){
    print("player_W Win !");
  }
  elseif(count($W_result) < count($B_result)){
    print("player_B Win !");
  }
  else{
    print("you are draw !");
  }
  break;
}




}




// デバックするときに、注目する必要がある点。