<?= view('partials/head') ?>

<body>
    <div class="container">
        <div class="card col-lg-6 mx-auto mt-5">
            <div class="card-header bg-primary text-white mt-2"><?= $title ?> Account</div>
            <div class="card-body">

                <form action="<?= base_url('register/save'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="nama">Name</label>
                        <input type="text" class="form-control <?= (validation_show_error('surename')) ? 'is-invalid' : ''; ?>" id="surename" name="surename" value="<?= old('surename'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('surename'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('email'); ?>
                        </div>
                    </div>

                    <div class="form row">
                        <div class="form-group col-md-8">
                            <label for="file">File</label>
                            <input type="file" class="form-control-file <?= (validation_show_error('ava')) ? 'is-invalid' : ''; ?>" id="ava" name="ava" value="<?= old('ava'); ?>" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= validation_show_error('ava'); ?>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <img src="avatar/default.png" class="img-thumbnail img-preview">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control costum-file <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
                            <div class="invalid-feedback">
                                <?= validation_show_error('password'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control <?= (validation_show_error('cpassword')) ? 'is-invalid' : ''; ?>" id="cpassword" name="cpassword">
                            <div class="invalid-feedback">
                                <?= validation_show_error('cpassword'); ?>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Register Account
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="<?= base_url('login') ?>">Already have an account? Login!</a>
                </div>

            </div>
        </div>
    </div>
    <?= view('partials/footer') ?>

</body>

</html>