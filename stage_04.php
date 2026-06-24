<?php
/**
 * ルール
 * 1行目の入力値にダンジョンの部屋数Nと
 * プレイヤー数Mが半角スペース区切りで与えられる
 * 2行目以降の入力値は、
 * プレイヤーの滞在部屋S_iと移動先部屋T_iが与えられる
 * 
 * デッドロックの発生条件は、どの順番で移動しても移動できない
 * プレイヤーが存在するかどうかです。
 * 
 * ゴール
 * デッドロックが発生するかどうかを判定するロジックを組む
 * 結果は、Yes or Noで出力する
*/
/* 変数定義 */
list($n,$m) = explode(' ',trim(fgets(STDIN)));
// echo "{$n} {$m}";
$member = array(); # プレイヤーの移動情報

/* 処理 */
for($i=0;$i<$m;$i++) {
    list($key,$value) = explode(' ',trim(fgets(STDIN)));
    $member[$key] = $value;
}
// print_r($member);
start_loop:
foreach($member as $key => $value) {
    if($value == $key) {
        $member[$key] = '移動済';
        goto start_loop;
    }
    if(array_key_exists($value,$member) || $value == '移動済') {
        // echo "{$value}は存在します\n";
        continue;
    } else {
        // echo "{$value}は存在しません\n";
        $member[$value] = '移動済';
        unset($member[$key]);
        goto start_loop;
    }
}
// print_r($member);
$result = array_diff($member,['移動済']);
// var_dump($result);

if(empty($result)) {
    echo 'No';
}else {
    echo 'Yes';
}