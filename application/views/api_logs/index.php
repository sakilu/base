<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <title>除錯用</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th style="width: 100px">時間</th>
                <th style="width: 120px">ip</th>
                <th style="width: 70px">method</th>
                <th style="width: 200px">url</th>
                <th>表頭</th>
                <th>表身</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?= $row->api_logs_created_at ?></td>
                    <td><?= $row->api_logs_ip ?></td>
                    <td><?= $row->api_logs_method ?></td>
                    <td><?= $row->api_logs_url ?></td>
                    <td>
                        <?php foreach (json_decode($row->api_logs_request_head) as $k => $v) { ?>
                            <?= $k . ':' . $v . '<br >'; ?>
                        <?php } ?></td>
                    <td><?= urldecode($row->api_logs_request_body) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<style>
    table {
        table-layout: fixed;
        word-break: break-all;
    }
</style>
</body>
</html>