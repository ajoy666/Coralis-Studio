<?= view('partials/head') ?>

<body>
    <div class="container">
        <div class="card col-lg-6 mx-auto mt-5">
            <div class="card-header bg-primary text-white mt-2"><?= $title ?> Account</div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="col-md-auto mb-4">
                        <img src="avatar/<?= session()->get('ava') ?>" style="max-width: 300px; max-height: 400px" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="surename"><b>Name</b></label>
                    </div>
                    <label for="surename"><?= session()->get('surename') ?></label>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="surename"><b>Email</b></label>
                    </div>
                    <label for="surename"><?= session()->get('email') ?></label>
                </div>

                <hr>

                <a class="btn btn-secondary btn-user btn-block" href="<?= base_url('logout') ?>" onclick="return confirm('Are you sure to logout?')">Logout</a>
            </div>
        </div>
    </div>
    <?= view('partials/footer') ?>


</body>

</html>