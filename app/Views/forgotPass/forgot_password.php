<?= view('partials/head') ?>

<body>
    <div class="container">
        <div class="card col-lg-6 mx-auto mt-5">
            <div class="card-header bg-primary text-white mt-2">Forgot Your Password?</div>
            <div class="card-body">
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

                <form action="forgot-send" method="post">
                    <?= csrf_field() ?>


                    <div class="form-group">
                        <label for="email">Enter Your Registered Email</label>
                        <input type="text" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('email'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Reset Password
                    </button>
                </form>
                <hr>

                <div class="text-center">
                    <a class="small" href="<?= base_url('login') ?>">Back to login</a>
                </div>

            </div>
        </div>
    </div>

</body>

</html>