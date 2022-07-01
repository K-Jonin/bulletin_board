<?php

require_once '../../config.php';

$error_mess = [
    'name' => '',
    'genle' => '',
    'message' => ''
];

//初期画面表示
$fp = fopen(PATH . FILE, 'r');
$array = [];
$array2 = [];

while ($row = fgets($fp)) {
    $row = explode(',', $row);
    if ($row[6] == 0 && $row[4] == '') { //投稿を配列に挿入
        $array[] = $row;
    } elseif ($row[6] == 0 && $row[4] != '') { //返信を配列に挿入
        $array2[] = $row;
    }
}
$array = array_reverse($array);
$array2 = array_reverse($array2);

fclose($fp);

//$_POST['state'] & $_GET['type']が無い場合
if (!isset($_POST['state']) && !isset($_GET['type']) && !isset($_GET['genleSearch'])) {
    require_once './tpl/index.php';
    exit();
}

//投稿ボタンが押された時の処理
if (isset($_POST['state']) && $_POST['state'] == 'post' && !isset($_GET['type'])) {

    //ファイル読み込み
    $fp = fopen(PATH . FILE, 'r');
    $id = 1;
    while ($row = fgets($fp)) {
        $row = explode(',', $row);
        if ($id <= (int) $row[0]) {
            $id = (int) $row[0] + 1;
        }
    }
    fclose($fp);

    $img_name = '';
    //画像が送信された時の処理
    if ($_FILES['imgFile']['name'] != '') {
        $uplode_file = $_FILES['imgFile'];
        $img_name = $id . '.jpg';
        move_uploaded_file($uplode_file['tmp_name'], UPLOAD_PATH . $img_name);
    }

    //ファイル書き出し
    $push = $id . ",";
    $push .= $_POST['name'] . ",";
    $push .= $_POST['message'] . ",";
    $push .= $_POST['genle'] . ",";
    $push .= ",";
    $push .= $img_name . ",";
    $push .= "0,";
    $push .= date('YmdHis');

    $fp = fopen(PATH . FILE, 'a');
    fputs($fp, $push . "\n");
    fclose($fp);
}


if (isset($_GET['type'])) {
    //削除ボタンが押された時の処理
    if ($_GET["type"] == "delete") {
        //ファイル読み込み
        $fp = fopen(PATH . FILE, 'r+');
        $delete_array = [];
        while ($row = fgets($fp)) {
            $row = explode(',', $row);
            if ($_GET['id'] == $row[0]) {
                $row[6] = 1;
            }
            $delete_array[] = $row;
        }
        fclose($fp);

        //ファイルを空にする
        $fp = fopen(PATH . FILE, 'w');
        fclose($fp);

        //ファイル書き込み        
        $fp = fopen(PATH . FILE, "a");
        foreach ($delete_array as $da) {
            $push2 = $da[0] . "," . $da[1] . "," . $da[2] . "," . $da[3] . "," . $da[4] . "," . $da[5] . "," . $da[6] . "," . $da[7];
            fputs($fp, $push2);
        }
        fclose($fp);
        header('Location: ./index.php');
    }

    //Reが押された時の処理
    if ($_GET['type'] == 're' && isset($_POST['state'])) {
        //ファイル読み込み
        $fp = fopen(PATH . FILE, 'r');
        $id = 1;
        while ($row = fgets($fp)) {
            $row = explode(',', $row);
            if ($id <= (int) $row[0]) {
                $id = (int) $row[0] + 1;
            }
        }
        fclose($fp);

        $img_name = '';
        //画像が送信された時の処理
        if ($_FILES['imgFile']['name'] != '') {
            $uplode_file = $_FILES['imgFile'];
            $img_name = $id . '.jpg';
            move_uploaded_file($uplode_file['tmp_name'], UPLOAD_PATH . $img_name);
        }

        //ファイル書き出し
        $push = $id . ",";
        $push .= $_POST['name'] . ",";
        $push .= $_POST['message'] . ",";
        $push .= $_POST['genle'] . ",";
        $push .= $_GET['id'] . ",";
        $push .= $img_name . ",";
        $push .= "0,";
        $push .= date('YmdHis');

        $fp = fopen(PATH . FILE, 'a');
        fputs($fp, $push . "\n");
        fclose($fp);
    }
}

//ジャンルサーチ
if (isset($_GET['genleSearch'])) {

    $genle = $_GET['genleSearch'];
    $fp = fopen(PATH . FILE, 'r');
    $array = [];
    while ($row = fgets($fp)) {
        $row = explode(',', $row);
        if ($row[6] == 0 && $row[4] == '' && $row[3] == $genle) {
            $array[] = $row;
        } elseif ($row[6] == 0 && $row[4] != '' && $row[3] == $genle) { //返信を配列に挿入
            $array2[] = $row;
        }
    }
    fclose($fp);

    $array = array_reverse($array);
    $array2 = array_reverse($array2);

    require_once './tpl/index.php';
    exit;
}


//画面表示
$fp = fopen(PATH . FILE, 'r');
$array = [];
$array2 = [];

while ($row = fgets($fp)) {
    $row = explode(',', $row);
    if ($row[6] == 0 && $row[4] == '') { //投稿を配列に挿入
        $array[] = $row;
    } elseif ($row[6] == 0 && $row[4] != '') { //返信を配列に挿入
        $array2[] = $row;
    }
}

$array = array_reverse($array);
$array2 = array_reverse($array2);

fclose($fp);

require_once './tpl/index.php';
exit;
