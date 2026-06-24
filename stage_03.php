<?php
/**
 * ルール
 * 1行目の入力値1つ目にコマンドの種類を表すNが与えられる
 * 1行目の入力値2つ目にパラメータ列の長さを表すMが与えられる
 * 1行目の入力値3つ目に時系列データの長さを表す整数Lが与えられる
 * 
 * 補足
 * ➀半角区切りのコマンドの種類Nは、3種類や6種類
 * ➁パラメータのデータ変化量は、行で見る、-8 7 6がコマンド１の変化量
 * Mは横の長さです。
 * ➂時系列データは、直前と直後のデータの差分をもとめて
 * 変化量が一致するパラメータを探す
 * 
 * ゴール
 * 時系列データのパラメータ変化量を求めてどのコマンドに該当するか
 * 末尾に改行を加えて1行ずつ出力する。
*/
/* 変数定義 */
list($n,$m,$l) = explode(' ',trim(fgets(STDIN)));
// echo "{$n}\t{$m}\t{$l}";
$command = array(); # コマンド格納用
$timeSeries = array(); # 時系列データ格納用


/* 処理 */
$command = getData($n,false);
$new_keys = range(1,count($command));
$command = array_combine($new_keys,$command);

$timeSeries = getData($l,true);
// var_dump($command);
// var_dump($timeSeries);

for($i=0;$i<$l-1;$i++) {
    $result = '';
    for($e=0;$e<$m;$e++) {
        if($timeSeries[$i][$e])
        $value = $timeSeries[$i+1][$e] - $timeSeries[$i][$e];
        if ($e+1 == $m) {
         $result .= $value;   
        } else {
            $result .= $value.' ';
        }
    }
    // echo $result.PHP_EOL;
    if(in_array($result,$command)){
        echo array_search($result,$command,true).PHP_EOL;
    } else {
        echo '存在しません'.PHP_EOL;
    }
}


/* 関数定義 */
function getData($count,$slice){
    $lists = array();
    for($i=0;$i<$count;$i++) {
        $value = trim(fgets(STDIN));
        if($slice == true) {
            array_push($lists,explode(' ',$value));
        } else {
            array_push($lists,$value);
        }
    }
    return $lists;
}