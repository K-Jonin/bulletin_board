<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div id="post">
        <form method="post" enctype="multipart/form-data">
            <dl>
                <div class="inputFlex">
                    <dt>ニックネーム</dt>
                    <dd><input type="text" name="name"></dd>
                    <dt>ジャンル</dt>
                    <dd>
                        <select name="genle" id="genle">
                            <option value="">選択してください</option>
                            <option value="映画">映画</option>
                            <option value="本">本</option>
                            <option value="音楽">音楽</option>
                        </select>
                    </dd>
                </div>
                <dt>メッセージ</dt>
                <dd><textarea name="message" cols="40" rows="7"></textarea></dd>
                <dt>画像</dt>
                <dd><input type="file" name="imgFile"></dd>
            </dl>
            <button type="submit" name="state" value="post">投稿</button>
        </form>
    </div>
    <div id="main">
        <form id="search">
            <dl>
                <dt>ジャンルを選択</dt>
                <dd>
                    <select name="genleSearch">
                        <option value="">選択してください</option>
                        <option value="映画">映画</option>
                        <option value="本">本</option>
                        <option value="音楽">音楽</option>
                    </select>
                </dd>
                <dd><button type="submit" name="search">検索</button></dd>
            </dl>
        </form>
        <div id="articles">
            <?php foreach ($array as $ar) : ?>
                <div class="article">
                    <p>
                        <!-- id --><?php echo $ar[0]; ?>
                        <!-- name -->ニックネーム：<?php echo  $ar[1]; ?>
                        <!-- date --><?php echo date("Y/m/d H:i:s", strtotime($ar[7])); ?>
                        <!-- Re -->[<a href="./index.php?type=re&id=<?php echo $ar[0]; ?>">Re</a>]
                        <!-- delete -->[<a href="./index.php?type=delete&id=<?php echo $ar[0]; ?>">削除</a>]
                    </p>
                    <p>
                        <!-- image --><img src="./images/<?php echo $ar[5]; ?>" alt="">
                        <!-- article --><?php echo $ar[2]; ?>
                    </p>
                </div>
                <?php foreach ($array2 as $ar2) : ?>
                    <?php if ($ar2[4] == $ar[0]) : ?>
                        <div class="re">
                            <p>
                                <!-- id --><?php echo $ar2[0]; ?>
                                <!-- name -->ニックネーム：<?php echo  $ar2[1]; ?>
                                <!-- date --><?php echo date("Y/m/d H:i:s", strtotime($ar2[7])); ?>
                                <!-- delete -->[<a href="./index.php?type=delete&id=<?php echo $ar2[0]; ?>">削除</a>]
                            </p>
                            <p>
                                <!-- image --><img src="./images/<?php echo $ar2[5]; ?>" alt="">
                                <!-- article --><?php echo $ar2[2]; ?>
                            </p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>