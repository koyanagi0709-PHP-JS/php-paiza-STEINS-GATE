<?php
/**
 * ルール
 * １行目に半角スペース区切りで
 * キャラクター数Nと１戦闘での獲得経験値Kが与えられる
 * 続く２行目以降は、各キャラクターのレベルアップ経験値が与えられる
 * 
 * ゴール
 * 全キャラクターがレベルアップするのに必要な戦闘回数を求め出力する
*/
/* 変数定義 */
list($n,$k) = explode(' ',trim(fgets(STDIN)));
// echo $n,$k;
$members = array(); #各キャラクターの経験値を格納する配列
$totalVal = 0; # 必要経験値合計
$count = 0; #必要戦闘回数

/* 処理 */
$k = doubleval($k);

for($i=0;$i<$n;$i++) {
    array_push($members,doubleval(trim(fgets(STDIN))));
}
$totalVal = array_sum($members);
// echo $totalVal;

$count = ceil(($totalVal / $k));

echo $count;