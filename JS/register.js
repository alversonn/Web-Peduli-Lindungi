let Kewarganegaraan = document.getElementById('Kewarganegaraan');
let LabelNik = document.querySelector('.input-box:nth-child(3) label');
let Nomor_pasport = document.getElementById('no_pasport');
let Nik = document.getElementById('Nik');
let pesan_passport = document.getElementById('pesan-passport');
let pesan_sandi = document.getElementById('pesan-sandi');
let submit = document.getElementById('submit');
let sandi = document.getElementById('sandi');
let konfirmasi_sandi = document.getElementById('konfirmasi_sandi');

// sandi.addEventListener('keyup', function() {
//     sandi.style.border = 'none';
//     konfirmasi_sandi.style.border = 'none';
//     pesan_sandi.style.display = 'none';
// })

submit.addEventListener('click', function(e) {
    if (sandi.value != konfirmasi_sandi.value) {
        e.preventDefault();
        sandi.style.border = '2px solid red';
        konfirmasi_sandi.style.border = '2px solid red';
        pesan_sandi.style.display = 'inline-block'
        return false;
    }
})

Kewarganegaraan.addEventListener('click', function() {
    if (this.value === "Warga Negara Asing") {
        Nik.name = 'negara';
        Nik.placeholder = 'masukkan negara anda';
        Nik.removeAttribute('maxlength');
        Nik.removeAttribute('minlength');
        LabelNik.innerText = 'Negara';
        Nomor_pasport.style.border = '2px solid red';
        Nomor_pasport.placeholder = 'Masukkan No Pasport (wajib)'
        pesan_passport.style.display = 'inline-block';
        Nomor_pasport.setAttribute('required','');
    }else {
        Nik.name = 'nik';
        Nik.placeholder = 'Masukkan NIK';
        Nik.setAttribute('minlength',15);
        Nik.setAttribute('maxlength',16);
        LabelNik.innerText = 'Nik';
        Nomor_pasport.style.border = 'none';
        pesan_passport.style.display = 'none';
        Nomor_pasport.removeAttribute('required');
        Nomor_pasport.placeholder = "Masukan No Pasport (Optional)";
    }
})