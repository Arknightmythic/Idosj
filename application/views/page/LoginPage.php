<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("/assets/styles/auth.css"); ?>">
    <?= $css?>
    <?= $js?>
</head>

<body>
    <div class="auth-container">
        <div class="col-0 col-md-6 col-xl-7 img-wrapper">
            <img class="img-wallpaper"
                src="https://jesuits.id/wp-content/uploads/2022/04/SJES-Congress-PG-con-mujeres-min-2048x1453.jpg"
                alt="Login Wallpaper">
        </div>
        <div class="col-12 col-md-6 col-xl-5 login-card px-5 d-flex flex-column justify-content-center">
            <form class="position-relative px-1 px-md-5" method="post">
                <div class="d-flex flex-column flex-md-row login-header position-absolute">
                    <img class="img-logo" src="<?= base_url("assets/images/logo-ihs.png") ?>" alt="LOGO SJ" />
                    <h1 class="ms-3">Login</h1>
                </div>
                <?php if(!empty($this->session->flashdata('login'))){ ?>
                <div class="alert alert-danger my-3" role="alert">
                    <?= $this->session->flashdata('login') ?>
                </div>
                <?php } ?>
                <div class="form-group my-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                        required>
                </div>
                <div class="form-group my-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="<?= base_url("/auth/forgot-password") ?>" class="text-primary">Forgot password?</a>
                </div>
                <div class="form-group d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary mt-4 px-4 py-2">Login</button>
                </div>
            </form>
        </div>
    </div>
    </script>
</body>

</html>