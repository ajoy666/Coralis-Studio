<?= view('partials/head') ?>

<body>
    <div class="container">
        <div class="card col-lg-6 mx-auto mt-5">
            <div class="card-header bg-primary text-white mt-2"><?= $title ?> Account</div>
            <div class="card-body">
                <?php
                if (session()->getFlashData('message')) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('message') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }
                ?>

                <?php
                if (session()->getFlashData('error')) {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }
                ?>

                <form action="<?= base_url('login/process') ?>" method="post">
                    <?= csrf_field() ?>


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('email'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
                        <div class="invalid-feedback">
                            <?= validation_show_error('password'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                </form>
                <hr>
                <div class="text-center mb-2">
                    <a class="small" href="<?= base_url('forgot-password') ?>">Forgot password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="<?= base_url('register') ?>">Create an account!</a>
                </div>

            </div>
        </div>
    </div>
    <?= view('partials/footer') ?>

</body>

</html>