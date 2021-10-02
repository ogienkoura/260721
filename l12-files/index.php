<?php

require_once __DIR__ . '/lib/directories.php';
require_once __DIR__ . '/breadcrumbs.php';

$rout = prepareRout($_GET['rout'] ?? '');

$items = readDirectory($rout);
$crumbs = getCrumbs($rout);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
<div class="container mt-3">
    <div class="row">
        <div class="col-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newDirModal">
                Create Directory
            </button>
        </div>
        <div class="col-8">
            <form action="upload-files.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="rout" value="<?= $rout ?>">
                <div class="row">
                    <div class="col-8">
                        <input type="file" name="upload" class="form-control">
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mt-3">
            <?php foreach ($crumbs as $crumb): ?>
                <?php if (!empty ($crumb['url'])) { ?>
                    <li class="breadcrumb-item"><a href="<?= $crumb['url'] ?>"><?= $crumb['text'] ?></a></li>
                <?php } else {?>
                <li class="breadcrumb-item active" aria-current="page"><?= $crumb['text'] ?></li>
            <?php } endforeach; ?>
        </ol>
    </nav>
    <div class="row">
        <div class="ccl-4">
            <ul class="list-unstyled mt-3">
                <?php foreach ($items as $item): ?>
                    <li>
                        <a href="index.php?rout=<?= $item['rout'] ?>">
                            <?= $item ['name'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="ccl-8">

        </div>
    </div>
</div>
<div class="modal fade" id="newDirModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enter new directory name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="create-dir.php" method="post" id="createDirForm">
                    <input type="hidden" name="rout" value="<?= $rout ?>">
                    <label class="w-100">
                        <input type="text" name="dirName" class="form-control">
                    </label>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="createDirForm">Create Directory</button>
            </div>
        </div>
    </div>
</div>

<script src="/l12-files/js/bootstrap.bundle.js"></script>
</body>
</html>


