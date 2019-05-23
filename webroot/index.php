<?php
require_once dirname ( __FILE__ ) . '/../UnnaturalJapaneseGenerator/UnnaturalJapaneseGenerator.php';
require_once dirname ( __FILE__ ) . '/../UnnaturalJapaneseGenerator/Utility.php';

use UnnaturalJapaneseGenerator\UnnaturalJapaneseGenerator;
use UnnaturalJapaneseGenerator\Utility;

$post_text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$post_text = str_replace(')', '', str_replace('(', '', $post_text));
$ujg_text  = new UnnaturalJapaneseGenerator($post_text);

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
    <!-- twitter card -->
    <meta name="twitter:card" content="summary" />
    <meta property="og:url" content="https://www.apps.danishi.net/ujg/" />
    <meta property="og:title" content="不自然な日本語ジェネレーター" />
    <meta property="og:description" content="日本語を中国語に翻訳してから再度日本語に翻訳しなおすことで、翻訳ミスしたような不自然な日本語を生成します。" />
    <meta property="og:image" content="img/study_nihongo.png" />
    <!-- twitter card -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?<?=Utility::cssUnCache()?>">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/gtag.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">不自然な日本語ジェネレーター</a>
        </nav>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <form id="submit_area" action="" method="post">
                <div class="form-group">
                    <p></p>
                    <p class="text-info">日本語を中国語に翻訳してから再度日本語に翻訳しなおすことで、翻訳ミスしたような不自然な日本語を生成します。
                    <br>Twitterに投稿してフォロワーをざわつかせたり、自由にお使いください。<p>

                    <textarea name="text" class="form-control" rows="10" maxlength="1000" placeholder="変換したいテキストを入力してください。"><?= $post_text ?></textarea>
                    <div id="countor_area" class="text-muted">
                        <span id="countor">0</span>/1000
                    </div>
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> 変換</button>
            </form>

            <div class="card">
                <div class="card-header">
                    変換後テキスト
                </div>
                <div class="card-body">
                    <?= $ujg_text ?>
                </div>
                <button id="select_btn" class="btn( btn-info"><i class="far fa-clipboard"></i> 選択</button>
            </div>
            <?php if(!empty($post_text)) : ?>
            <hr>
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw&text=<?= urlencode($ujg_text.' #不自然な日本語ジェネレーター') ?>"
            class="twitter-share-button" data-show-count="false" data-size="large">ツイート</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            <?php endif; ?>
            <p></p>
        </div>
    </main>

    <footer class="footer mt-auto py-1">
        <div class="container">
            <p class="text-muted">Created by <a target="_blank" href="https://twitter.com/Danishi411">Danishi</a>.</p>
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
