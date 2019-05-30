<!DOCTYPE>
<html lang="ja">
<head>
{include file='template/head_tag.tpl'}
</head>
<body class="d-flex flex-column h-100">
    {include file='template/header.tpl' title=$title}
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <form id="submit_area" action="" method="post">
                <div class="form-group">
                    <p></p>
                    <p class="text-info">日本語を中国語に翻訳してから再度日本語に翻訳しなおすことで、翻訳ミスしたような不自然な日本語を生成します。
                    <br>Twitterに投稿してフォロワーをざわつかせたり、自由にお使いください。<p>

                    <textarea name="text" class="form-control" rows="10" maxlength="1000" placeholder="変換したいテキストを入力してください。">{$post_text}</textarea>
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
                    {$ujg_text}
                </div>
                <button id="select_btn" class="btn( btn-info"><i class="far fa-clipboard"></i> 選択</button>
            </div>
            {if !empty($post_text)}
            <hr>
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw&text={$ujg_text} #不自然な日本語ジェネレーター"
            class="twitter-share-button" data-show-count="false" data-size="large">ツイート</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            {/if}
            <p></p>
        </div>
    </main>
</body>
{include file='template/footer.tpl' copyright='danishi'}
{include file='template/foot_tag.tpl'}
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
