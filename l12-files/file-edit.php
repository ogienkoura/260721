<?php

require_once __DIR__ . '/lib/directories.php';
require_once __DIR__ . '/lib/files.php';
require_once __DIR__ . '/lib/response.php';

$rout = $_GET['rout'] ?? '';
$path = preparePath($rout);
if (mime_content_type($path) !== 'text/plain'){
redirect ('/l12-files/index.php?isDir=0&rout=' . $rout);
}
$content = file_get_contents($path);



function textFileSave (string $rout): string
{
    return "<a href='/l12-files/file-edit.php?rout={$rout}' class='btn btn-info mt-3'>Save</a>";
}





?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>
<body>
<form action="/l12-files/save-edited.php" method="post">
    <input type="hidden" name="rout" value="<?= $rout ?>">
        <div class="form-block mb-3">
            <textarea
                    name="comment"
                    id="chat-comment"
                    class="form-control"
            > <?= $content ?> </textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>


</div>
</body>
</html>


