let btn_profile = document.querySelector('.profile-box');
let btn_sertifikat = document.querySelector('.sertifikat-box');
let a_sertifikat = document.getElementById('btn-sertifikat');
let a_profile = document.getElementById('btn-profile');
const profile = document.querySelector('.profile');
const sertifikat = document.querySelector('.sertifikat');
let img_profile = document.getElementById('img-profile');
let img_sertifikat = document.getElementById('img-sertifikat');
let editIcon = document.getElementById('edit');
let editIcon2 = document.getElementById('edit-2');
let btnUpload = document.getElementById('gambar');
let nama = document.getElementById('nama');
const p = document.getElementById("profile-header");
const logo = document.querySelector(".logo");


logo.addEventListener("click", function () {
  document.location.href = "index.php";
});

btn_sertifikat.addEventListener('click', function() {
   btn_profile.style.backgroundColor = 'white';
   btn_sertifikat.style.backgroundColor = '#269AD7';
   a_sertifikat.style.color = 'white';
   img_sertifikat.src = "img/certificate (1).png";
   a_profile.style.color = '#269AD7';
   img_profile.src = "img/user (1).png";
   profile.style.display = 'none';
   sertifikat.style.display = 'inline-block';
   p.style.display = 'none';
})

btn_profile.addEventListener('click', function() {
    btn_sertifikat.style.backgroundColor = 'white';
    btn_profile.style.backgroundColor = '#269AD7';
    a_profile.style.color = 'white';
    img_profile.src = "img/user (2).png";
    a_sertifikat.style.color = '#269AD7';
    img_sertifikat.src = "img/certificate (2).png";
    profile.style.display = 'flex';
    sertifikat.style.display = 'none';
    p.style.display = "inline-block";
});

let btn_wrapper = document.querySelector('.btn-wrapper');

// console.log(btn_wrapper.childNodes[1].attributes[0].nodeValue);

if (btn_wrapper.childNodes[1].attributes[0].nodeValue === 'bungkus') {
    btnUpload.addEventListener('mouseenter',function() {
        editIcon2.style.display = 'inline-block';
    })
    
    btnUpload.addEventListener('mouseleave', function() {
        editIcon2.style.display = 'none';
    })
    
}else{
    btnUpload.addEventListener('mouseenter',function() {
        editIcon.style.display = 'inline-block';
        nama.style.display = 'none';
    })
    
    btnUpload.addEventListener('mouseleave', function() {
        editIcon.style.display = 'none';
        nama.style.display = 'inline-block';
    })
}

// console.log(p)