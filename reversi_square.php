<?php

print("  |GAME START|  \n  いずれかのキーを押してください-  \n");
echo fgets(STDIN);
print("1番目のプレイヤー。あなたはplayer_Wです\nいずれかのキーを押してください-\n");
echo fgets(STDIN);
print("2番目のプレイヤー。あなたはplayer_Bです\nいずれかのキーを押してください-\n");
echo fgets(STDIN);
print("ゲームを開始します\n");
//余裕あったらnoしたときにゲームやめる処理

#ゲーム



#初期値設定 二次元配列にする場合の変更点　置換処理もいらない。
for ($x = 1; $x < 9; $x++) {
  for ($y = 1; $y < 9; $y++) {
    $field[$x][$y] = 0;
  }
}
$field[4][4] = $field[5][5] = -1;
$field[4][5] = $field[5][4] = 1;
$player_W = 1;
$player_B = -1;
$field_check = $field;


#石表示プログラム

function reversi_view($field)
{
  $field = array_reduce($field, 'array_merge',[]);

  foreach ($field as $key => $value) {
    $value = "$value";
  }

  $field_view = str_replace("-1", "○", $field);
  $field_view = str_replace("1", "●", $field_view);
  $field_view = str_replace("0", " ", $field_view);

  echo " " . "|" . "1" . "|" . "2" . "|" . "3" . "|" . "4" . "|" . "5" . "|" . "6" . "|" . "7" . "|" . "8" . "|" . " " . "\n";
  echo "1" . "|" . $field_view[0] . "|" . $field_view[1] . "|" . $field_view[2] . "|" . $field_view[3] . "|" . $field_view[4] . "|" . $field_view[5] . "|" . $field_view[6] . "|" . $field_view[7] . "|" . "1" . "\n";
  echo "2" . "|" . $field_view[8] . "|" . $field_view[9] . "|" . $field_view[10] . "|" . $field_view[11] . "|" . $field_view[12] . "|" . $field_view[13] . "|" . $field_view[14] . "|" . $field_view[15] . "|" . "2" . "\n";
  echo "3" . "|" . $field_view[16] . "|" . $field_view[17] . "|" . $field_view[18] . "|" . $field_view[19] . "|" . $field_view[20] . "|" . $field_view[21] . "|" . $field_view[22] . "|" . $field_view[23] . "|" . "3" . "\n";
  echo "4" . "|" . $field_view[24] . "|" . $field_view[25] . "|" . $field_view[26] . "|" . $field_view[27] . "|" . $field_view[28] . "|" . $field_view[29] . "|" . $field_view[30] . "|" . $field_view[31] . "|" . "4" . "\n";
  echo "5" . "|" . $field_view[32] . "|" . $field_view[33] . "|" . $field_view[34] . "|" . $field_view[35] . "|" . $field_view[36] . "|" . $field_view[37] . "|" . $field_view[38] . "|" . $field_view[39] . "|" . "5" . "\n";
  echo "6" . "|" . $field_view[40] . "|" . $field_view[41] . "|" . $field_view[42] . "|" . $field_view[43] . "|" . $field_view[44] . "|" . $field_view[45] . "|" . $field_view[46] . "|" . $field_view[47] . "|" . "6" . "\n";
  echo "7" . "|" . $field_view[48] . "|" . $field_view[49] . "|" . $field_view[50] . "|" . $field_view[51] . "|" . $field_view[52] . "|" . $field_view[53] . "|" . $field_view[54] . "|" . $field_view[55] . "|" . "7" . "\n";
  echo "8" . "|" . $field_view[56] . "|" . $field_view[57] . "|" . $field_view[58] . "|" . $field_view[59] . "|" . $field_view[60] . "|" . $field_view[61] . "|" . $field_view[62] . "|" . $field_view[63] . "|" . "8" . "\n";
  echo " " . "|" . "1" . "|" . "2" . "|" . "3" . "|" . "4" . "|" . "5" . "|" . "6" . "|" . "7" . "|" . "8" . "|" . " " . "\n";
}

#プレイヤー変換と回数処理
#勝利条件

for ($turn = 1; $turn < 1000; $turn++) {
  if ($turn % 2 == 1) {
    $player = $player_W;
    $player_name = 'player_W';
  } else {
    $player = $player_B;
    $player_name = 'player_B';
  }

  if (in_array(0, array_column($field, 1)) ||
  in_array(0, array_column($field, 2)) ||
  in_array(0, array_column($field, 3)) ||
  in_array(0, array_column($field, 4)) ||
  in_array(0, array_column($field, 5)) ||
  in_array(0, array_column($field, 6)) ||
  in_array(0, array_column($field, 7)) ||
  in_array(0, array_column($field, 8))) {
    //ゲームをするプログラム

    reversi_view($field);
    echo "\n" . $player_name . "\n";
    print("あなたのターンです\n置きたい場所の縦列の番号と横列の番号を入力してください\n\n※　石をひっくり返せない場所に置くともう一度選択する必要が出てきます。\n※　パスをする場合、縦列、横列のいずれかで0または文字を入力してください\n");

    //数字だけしかないように入力制限をする。パス機能を付ける
    print("横列：");
    $col_f = fgets(STDIN);
    $col = intval($col_f);

    print("縦列：");
    $row_f = fgets(STDIN);
    $row = intval($row_f);

    if($col > 8 || $col < 0 || $row > 8 || $row < 0){
      $turn = $turn;
    }else{

    if ($col === 0 || $row === 0) {
      $turn = $turn + 1;
      echo "\n";
      print("pass!!");
      echo "\n";
    } else {

      //二次元配列の場合、colとrowをそのまま渡す 今までpushだった部分がcolとrowに変える。

      #置いた石を8方位を探してひっくり返す作業
      // $octas_array = [-9, -8, -7, -1, 1, 7, 8, 9];
      // $numberは[$number_c][$number_r]、$pushは[$col][$row]
      //心配なのはforeach周り、一度全部書き直したら確認をする。

      $octas_array = [[-1,-1],[0,-1],[1,-1],[-1,0],[1,0],[-1,1],[0,1],[1,1]];
      //石の上に置けない処理

      if ($field[$col][$row] === $player_W || $field[$col][$row] === $player_B) {
      } else {
        foreach ($octas_array as $octas) {
          $field_log = $field;
          $number_c = $col;
          $number_r = $row;
          for ($X = 1; $X < 8; $X++) {

            if ($number_c < 1 || $number_c > 8 || $number_r < 1 || $number_r > 8) {
              if ($X === 7) {
                if ($field[$number_c][$number_r] + $player === 0) {
                  $field[$number_c][$number_r] = $player;
                  $number_array_c[] = $number_c;
                  $number_array_r[] = $number_r;
          
                  #一番端に自分と同じ石がなかった時、リセット
          
                  foreach ($number_array_c as $key => $value) {
          
                    $field[$number_array_c[$key]][$number_array_r[$key]] = $field_log[$number_array_c[$key]][$number_array_r[$key]];
                  }
                  break;
                } else {
                  if ($field[$number_c][$number_r] === $player) {
                    #一番端が自分の石ならひっくり返す(今までひっくり返してきた石を元に戻さない)
                    $field[$col][$row] = $player;
                    break;
                  } else {
                    #違った場合リセット。
                    $number_array_c[] = $number_c;
                    $number_array_r[] = $number_r;
                    foreach ($number_array_c as $value) {
                      $field[$number_array_c[$key]][$number_array_r[$key]] = $field_log[$number_array_c[$key]][$number_array_r[$key]];
                    }
                    break;
                  }
                }
              } else {
                if ($field[$number_c][$number_r] === $player) {
                  #一番端が自分の石ならひっくり返す(今までひっくり返してきた石を元に戻さない)
                  $field[$col][$row] = $player;
                  break;
                } else {
                  #一番端が自分の石以外ならリセット
                  $number_array_c[] = $number_c;
                  $number_array_r[] = $number_r;
                  foreach ($number_array_c as $value) {
                    $field[$number_array_c[$key]][$number_array_r[$key]] = $field_log[$number_array_c[$key]][$number_array_r[$key]];
                  }
                  break;
                }
              }
            } else {
              if ($X === 1) {
                #探索する場所を決定し八方位探索する。
                $number_c = $number_c + $octas[0];
                $number_r = $number_r + $octas[1];
                if ($number_c < 1 || $number_c > 8 || $number_r < 1 || $number_r > 8) {
                  break;
                } else {
                  if ($field[$number_c][$number_r] + $player === 0) {
                    #石をひっくり返し、ひっくり返した場所の保存
                    $field[$number_c][$number_r] = $player;
                    $number_array_c = [$number_c];
                    $number_array_r = [$number_r];
                    $number_c = $number_c + $octas[0];
                    $number_r = $number_r + $octas[1];
                    if ($number_c < 1 || $number_c > 8 || $number_r < 1 || $number_r > 8) {
                      foreach ($number_array_c as $key => $value) {
                        $field[$number_array_c[$key]][$number_array_r[$key]] = $field_log[$number_array_c[$key]][$number_array_r[$key]];
                      }
                      break;
                    }
                  } else {
                    if ($field[$number_c][$number_r] === $player) {
                      break;
                    } else {
                      #違ったときリセット
                      $number_array_c[] = $number_c;
                      $number_array_r[] = $number_r;
                      foreach ($number_array_c as $key => $value) {
                        $field[$number_array_c[$key]][$number_array_r[$key]] = $field_log[$number_array_c[$key]][$number_array_r[$key]];
                      }
                      break;
                    }
                  }
                }
              } else {
                #1以外の処理
                if ($field[$number_c][$number_r] + $player === 0) {
                  #石をひっくり返し、ひっくり返した場所の保存
                  $field[$number_c][$number_r] = $player;
                  $number_array_c[] = $number_c;
                  $number_array_r[] = $number_r;
                  $number_c = $number_c + $octas[0];
                  $number_r = $number_r + $octas[1];
                  if ($number_c < 1 || $number_c > 8 || $number_r < 1 || $number_r > 8) {
                    foreach ($number_array_c as $key => $value) {
                      $field[$number_array_c[$key]][$number_array_r[$key]] = $field_log[$number_array_c[$key]][$number_array_r[$key]];
                    }
                    break;
                  }
                } else {
                  #一番端が自分の石ならひっくり返す(今までひっくり返してきた石を元に戻さない)
                  if ($field[$number_c][$number_r] === $player) {
                    $field[$col][$row] = $player;
                    break;
                  } else {
                    #違ったときリセット  forを使えばペアで撮ってこれる。今回は長さも同じなので。戻す処理、
                    $number_array_c[] = $number_c;
                    $number_array_r[] = $number_r;
                    foreach ($number_array_c as $key => $value) {
                      $field[$number_array_c[$key]][$number_array_r[$key]] = $field_log[$number_array_c[$key]][$number_array_r[$key]];
                    }
                    break;
                  }
                }
              }
            }
          }
        }
      }
    }
  }

    if ($field_check === $field) {
      $turn = $turn - 1;
    }

    $field_check = $field;
  } else {
    reversi_view($field);
    $W_result = array_keys($field, 1);
    $B_result = array_keys($field, -1);
    echo "\n";
    print("player_W_result:".$W_result);
    echo "\n";
    print("player_B_result:".$B_result);
    echo "\n";

    if (count($W_result) > count($B_result)) {
      print("player_W Win !");
    } elseif (count($W_result) < count($B_result)) {
      print("player_B Win !");
    } else {
      print("you are draw !");
    }
    break;
  }
}