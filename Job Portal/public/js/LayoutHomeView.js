console.log('WORK');

const hamburgerMenu = document.querySelector('.navbar-toggler');
const photoProfile = document.querySelector('.profile-thumbnail');
const inputPhotoProfile = document.querySelector('.input-photo-profile');
const cardJob = document.querySelectorAll('.card-job');
const detailJob = document.querySelector('.detail-job');
const descriptionJob = document.querySelector('.description');
const descJobDetail = document.querySelector('.desc-job');
const inputCV = document.querySelector('.input-cv');
const previewCV = document.querySelector('.preview-cv');
const buttonUploadCV = document.querySelector('.btn-upload-cv');
const csrf = document.querySelector('.txt-csrfname');
const alertNotifications = document.querySelector('.alert-notifications');

try {
    cardJob.forEach((e) => {
        e.addEventListener('click', (event) => {
            const idJob = e.children[0].value;
            const csrfName = csrf.getAttribute('name');
            const csrfHash = csrf.value;
            const firstTime = new Date().getTime();

            $.ajax({
                url: "/detail_job",
                method: "POST",
                data: {
                    [csrfName] : csrfHash,
                    idJob : idJob,
                },
                success: function(data){
                    let dataDetailJob = {};
                    const secondTime = new Date().getTime();

                    setTimeout(() => {
                        dataDetailJob = JSON.parse(data);
                        descJobDetail.innerHTML = `
                                <div class="container-fluid apply d-flex align-items-center justify-content-between">
                                    <div class="container-fluid">
                                        <input type="hidden" value="${dataDetailJob['data']['idJob']}">
                                        <button style="background-color: rgb(230,0,120); color: white" class="btn p-2 apply-job" type="button">
                                            Lamar Sekarang
                                        </button>
                                    </div>
                                    <div class="close">
                                        <button style="color: rgb(73,100,233)" class="btn close-button" type="button">Tutup</button>
                                    </div>
                                </div>
                                <div class="bg-company">
                                    <img class="img-fluid" src="/${dataDetailJob['data']['profileCompany']}" alt="">
                                </div>
                                <div class="mx-2 mt-3 desc-job-detail">
                                    <h3>${dataDetailJob['data']['namaJob']}</h3>
                                    <h5>${dataDetailJob['data']['namaCompany']}</h5>
                                    <h6>${dataDetailJob['data']['alamat']}</h6>
                                    <div class="mt-3 w-100">
                                        ${dataDetailJob['data']['deskripsiJob']}
                                    </div>
                                </div>
                    `
                    },firstTime-secondTime);

                    detailJob.classList.remove('d-none');
                    descriptionJob.classList.add('d-none');

                    if (Object.keys(dataDetailJob).length === 0 && dataDetailJob.constructor === Object) {
                        descJobDetail.innerHTML = `
                            <div class="d-grid justify-content-center align-items-center">
                                <img class="mx-auto" alt="Loading" src="/icons/Infinity-1s-200px.gif">
                                <p class="text-center fs-3">Loading...</p>
                            </div>
                        `
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            }).done(function (data) {
                const newTokenCSRF = JSON.parse(data);
                csrf.value = newTokenCSRF['csrf_token'];
            });
        })
    });

    window.addEventListener('click', (e) => {
        if (e.target.classList.contains('close-button')) {
            detailJob.classList.add('d-none');
            descriptionJob.classList.remove('d-none');
        }
        if (e.target.classList.contains('apply-job')) {
            let idJob = e.target.parentElement.children[0].value;
            const csrfName = csrf.getAttribute('name');
            const csrfHash = csrf.value;

            $.ajax({
                url: "/apply_job",
                method: "POST",
                data: {
                    [csrfName] : csrfHash,
                    idJob : idJob,
                },

                success: function(data){
                    const dataApply = JSON.parse(data);

                    const alert = `
                        <div class="alert alert-success alert-dismissible fade show col-7 mt-3" role="alert">
                            ${dataApply['checkCV']}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
                    alertNotifications.innerHTML = alert;
                },
                error: function(error) {
                    console.log(error)
                }
            }).done(function (data) {
                const newTokenCSRF = JSON.parse(data);
                csrf.value = newTokenCSRF['csrf_token'];
            });
        }
    });
} catch (e) {

}

try {
    photoProfile.addEventListener('error', function handleError() {
        photoProfile.src =  '/img/profile/404-error.png'
    });

    inputPhotoProfile.addEventListener('change', (e) => {
        const fileImage = inputPhotoProfile.files[0];
        if (fileImage) {
            photoProfile.src = URL.createObjectURL(inputPhotoProfile.files[0]);
        } else {
            inputPhotoProfile.classList.toggle('is-invalid');
            inputPhotoProfile.parentElement.children[2].textContent = "Silahkan Upload Gambar";
            photoProfile.src =  '/img/profile/404-error.png'
        }
    });

} catch (e) {

}

hamburgerMenu.addEventListener('click', (e) => {
    hamburgerMenu.children[1].classList.toggle('d-none');
    hamburgerMenu.children[0].classList.toggle('d-none');
});

try {
    inputCV.addEventListener('change', (e) => {
        const [file] = inputCV.files;
        const typeFile = file.type.split('/')[1];
        if (typeFile === 'pdf') {
            console.log("WORK");
            previewCV.src = URL.createObjectURL(file);
            previewCV.classList.remove('d-none');
            buttonUploadCV.children[0].classList.add('d-none');
            buttonUploadCV.classList.remove('none');
        } else {
            if (!previewCV.classList.contains('d-none')) {
                previewCV.classList.add('d-none');
            }
            if (buttonUploadCV.children[0].classList.contains('d-none')) {
                buttonUploadCV.children[0].classList.remove('d-none');
            }
            if (!buttonUploadCV.classList.contains('none')) {
                buttonUploadCV.classList.add('none');
            }
        }
    })
} catch (e) {

}

try {
    const changeNewCV = document.querySelector('.change-cv');
    const previewNewCV = document.querySelector('.preview-new-cv');

    changeNewCV.addEventListener('change', () => {
        const [file] = changeNewCV.files;
        if (file.type.split('/')[1] === 'pdf') {
            previewNewCV.src = URL.createObjectURL(file);
            !changeNewCV.parentElement.children[2].classList.contains('d-none') ?
                changeNewCV.parentElement.children[2].classList.add('d-none') : false;
        } else {
            changeNewCV.parentElement.children[2].classList.remove('d-none');
            return false;
        }
    })
} catch (e) {

}