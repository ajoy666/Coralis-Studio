<?= view('partials/head') ?>

<body>
    <div class="container">
        <div class="card col-lg-6 mx-auto mt-5">
            <div class="card-header bg-primary text-white mt-2">Reset Password</div>
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

                <form action="change-password" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control costum-file <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
                        <div class="invalid-feedback">
                            <?= validation_show_error('password'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control costum-file <?= (validation_show_error('cpassword')) ? 'is-invalid' : ''; ?>" id="cpassword" name="cpassword">
                        <div class="invalid-feedback">
                            <?= validation_show_error('cpassword'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Update New Password
                    </button>
                </form>

            </div>
        </div>
    </div>

</body>

</html>