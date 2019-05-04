<?php
require_once dirname ( __FILE__ ) . '/../UnnaturalJapaneseGenerator/UnnaturalJapaneseGenerator.php';

use UnnaturalJapaneseGenerator\UnnaturalJapaneseGenerator;

$post_text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$post_text = str_replace(')', '', str_replace('(', '', $post_text));

/*
todo
・ツイートボタン
・見た目を整える
*/

?>
<!DOCTYPE>
<html lang="ja">

<head>
    <title>不自然な日本語ジェネレーター</title>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name=description content="">
    <meta name=keywords content="誤翻訳">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?<?=time()?>>">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">不自然な日本語ジェネレーター</a>
                </div>
            </div>
        </nav>
    </header>
    <h1></h1>
    <main class="container">
        <form id="submit_area" action="index.php" method="post">
            <div class="jumbotron">
                <h4>無理矢理日本語変換したような不自然な日本語を生成します。</h4>
            </div>
            <div class="form-group">
                <p class="text-info">変換したいテキストを入力してください。<p>
                <textarea name="text" class="form-control" rows="10" maxlength="1000"><?= $post_text ?></textarea>
                <p class="text-muted">
                    <span id="countor">0</span>/1000
                </p>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> 変換</button>
            <a class="twitter-share-button"
                href="https://twitter.com/intent/tweet?text=Hello%20world"
                data-size="large">
            ツイートする</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </form>

        <div class="card">
            <div class="card-header">
                変換後テキスト
            </div>
            <div class="card-body">
                <?= new UnnaturalJapaneseGenerator($post_text) ?>
            </div>
            <button id="select_btn" class="btn btn-info"><i class="far fa-clipboard"></i> 選択</button>
        </div>

    </main>
    <footer class="footer">
        <div class="container">
            <p class="text-muted">copyright <a target="_blank" href="https://twitter.com/Danishi411">danishi</a></p>
        </div>
    </footer>
</body>
<script>
    $(function () {
        $('#countor').html($('textarea').val().length);

        $('textarea').bind('keydown keyup keypress change', function () {
            $('#countor').html($(this).val().length);
        });

        $('#select_btn').click(function(){
            var range = document.createRange();
            range.selectNodeContents($('.card-body')[0]);
            var selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
        });
    });
</script>

</html>
