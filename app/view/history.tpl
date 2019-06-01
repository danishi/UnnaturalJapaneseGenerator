<!DOCTYPE>
<html lang="ja">
{config_load file='smarty.config'}
<head>
{include file='template/head_tag.tpl'}
</head>
<body class="d-flex flex-column h-100">
    {include file='template/header.tpl' title=$title}
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width:40%">from</th>
                    <th style="width:40%">to</th>
                    <th style="width:20%">date</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$history_list item=history}
                <tr>
                    <td>{$history['before']}</td>
                    <td>{$history['after']}</td>
                    <td>{$history['date']}</td>
                </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    </main>
</body>
{include file='template/footer.tpl'}
{include file='template/foot_tag.tpl'}
</html>
