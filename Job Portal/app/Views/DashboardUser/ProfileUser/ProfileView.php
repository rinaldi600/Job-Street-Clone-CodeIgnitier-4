<?= $this->extend('DashboardUser/DashboardLayout') ?>

<?= $this->section('content') ?>
<div class="d-grid justify-content-center">
    <div class="profile-user">
        <div>
            <img style="width: 250px; height: 250px"
                 src="<?= base_url() ?>/<?= $profileUser['photo_profile'] ?>" class="img-thumbnail" alt="Photo Profile">
        </div>
        <div class="mx-auto d-grid justify-content-center">
            <p style="margin-bottom: -5px;" class="fs-3 fw-bold"><?= $profileUser['nama'] ?></p>
            <p style="margin-bottom: -3px;" class="text-center"><?= $profileUser['username'] ?></p>
            <p class="text-center"><?= str_replace(substr($profileUser['email'], 0,5),str_repeat('*',strlen($profileUser['email'])), $profileUser['email']) ?></p>
        </div>
        <input class="csrf-token" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
        <div class="d-grid justify-content-center">
            <div class="input-group input-group-sm">
                <input disabled type="hidden" class="form-control mb-3 email" aria-label="Sizing example input" value="rinaldih84@gmail.com" aria-describedby="inputGroup-sizing-sm">
            </div>
            <button type="button" onclick="showEmail(this)" class="btn btn-primary mx-auto">Show Email</button>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?render=6LenRqAgAAAAADIwEqG0WKKXjxs1qUIW5t52PL5r"></script>
<script>
    grecaptcha.ready(function() {
        // do request for recaptcha token
        // response is promise with passed token
        grecaptcha.execute('6LenRqAgAAAAADIwEqG0WKKXjxs1qUIW5t52PL5r', {action:'validate_captcha'})
            .then((token) => {
                onSubmit(token)
            })
            .catch((error) => {
                console.log(error)
            })
    });

    function onSubmit(response) {
        const csrfName = document.querySelector('.csrf-token');
        $.ajax({
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            url: "/dashboard_user/get_email",
            type: "post",
            dataType:"json",
            data: {
                [csrfName.getAttribute('name')]:csrfName.getAttribute('value'),
                response : response
            },
            success: function (response) {
               document.querySelector('.email').value = response.email;
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    let number = 0;
    function showEmail(e) {
        document.querySelector('.email').type = 'text';
        number++;
        if (number % 2 == 0 ) {
            document.querySelector('.email').type = 'hidden';
            e.textContent = 'Show Email';
        } else {
            document.querySelector('.email').type = 'text';
            e.textContent = 'Hide Email';
        }
    }
</script>
<?= $this->endSection() ?>
