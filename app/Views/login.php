<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student IS | Login</title>
    <link href="<?= base_url() ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="d-flex align-items-center vh-100">
        <div class="container card shadow-sm p-4" style="width:400px">
            <h1>Login</h1>
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-danger">
                    <?= esc(session()->getFlashdata('message')) ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <label class="form-label mt-2">Username</label>
                <input type="text" class="form-control" name="username" required>
                <label class="form-label mt-2">Password</label>
                <input type="password" class="form-control" name="password" required>
                <button class="btn btn-primary mt-2">Login</button>
            </form>
        </div>
    </div>


    <script src="<?= base_url() ?>bootstrap\dist\js\bootstrap.bundle.js"></script>

</body>

</html>