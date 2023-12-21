const logo = document.querySelector(".logo");
const btn = document.querySelectorAll(".btn");
const btn_submit = document.querySelector(".btn-submit");
const body = document.querySelector("body");
const black_screen = document.querySelector(".black-screen");
const list_card = document.querySelector(".list-card");
let list_kota = "";
let jml_listkota = 0;
let lokasi;
let latitude = 0;
let longitude = 0;


logo.addEventListener('click', function(){
    document.location.href = "index.php";
});

document.getElementById("format").addEventListener('click', function() {
  document.getElementById("county").innerText = "DI " + this.value;
  document.querySelector(".terdeteksi").style.display = "none";

})


btn_submit.addEventListener('click', function(){
  if (btn_submit.getAttribute("data-submit") === "no"){
    let Selected = document.getElementById("format").value
    cariFaskes(Selected);
    body.style.overflow = "hidden";
    btn_submit.setAttribute("data-submit","yes");
    black_screen.style.display = "inline-block";
    list_card.style.display = "inline-block";
  }

})

function cariFaskes(kota) {
  let camelcase = kapitalgenerator(kota);

  fetch(`https://api.vaksinasi.id/locations/Jawa%20Barat?city=Kota Depok`)
    .then((respone) => respone.json())
    .then((respone) => {
      let asu = respone.data;
      asu.forEach((element, i) => {
        list_kota += `<div class="card-lokasi">
                          <div class="header-caard">
                              <h4>${element.title}</h4>
                              <p style="font-size: 14px;">${element.address}</p>
                          </div>
                          <div class="main-card">
                              <div class="status-faskes">
                                  <img src="img/checked.png" alt="" srcset="">
                                  <p style="font-size: 14px;">Siap Vaksinasi</p>
                              </div>
                              <div class="nomor-faskes" style="width: 50px;">
                                  <img src="img/telephone.png" alt="">
                                  <p style="font-size: 14px;">-</p>
                              </div>
                              <a href="" class="arahkan">
                                  <img src="img/map.png" alt="" srcset="">
                                  <p style="font-size: 14px;">arahkan</p>
                              </a>
                          </div>
                          <div class="btn-info">
                              <p style="font-size: 15px;">INFO SELENGKAPNYA</p>
                          </div>
                          </div>`;
      });
      jml_listkota+=asu.length;
      // list_asu += list_kota;
      // console.log(list_kota)
      // document.querySelector("list-lokasi").innerHTML = list_kota;
    });

  fetch(`https://kipi.covid19.go.id/api/get-faskes-vaksinasi?city=${kota}`)
    .then((respone) => respone.json())
    .then((respone) => {
      let asi = respone.data;
      asi.forEach((element) => {
        if (element.alamat == null || element.telp == null || element.telp == "0-0") {
          list_kota += ``;
        }else {
          alamat = element.alamat;
          telp = element.telp;
          list_kota += `<div class="card-lokasi">
                          <div class="header-caard">
                              <h4>${element.nama}</h4> 
                              <p style="font-size: 14px;">${alamat}</p>
                          </div>
                          <div class="main-card">
                              <div class="status-faskes">
                                  <img src="img/checked.png" alt="" srcset="">
                                  <p style="font-size: 14px;">${element.status}</p>
                              </div>
                              <div class="nomor-faskes">
                                  <img src="img/telephone.png" alt="">
                                  <p style="font-size: 14px;">${telp}</p>
                              </div>
                              <a href="" class="arahkan">
                                  <img src="img/map.png" alt="" srcset="">
                                  <p style="font-size: 14px;">arahkan</p>
                              </a>
                          </div>
                          <div class="btn-info">
                              <p style="font-size: 15px;">INFO SELENGKAPNYA</p>
                          </div>
                      </div>`;
        }
      });
      jml_listkota+=asi.length
      document.querySelector("list-lokasi").innerHTML = list_kota;
    });
    
    // console.log(list_kota);
}

function kapitalgenerator(str) {
  let string = str.split("");
  let hurufdepan = string[0];
  let hurfubelakang = string.slice(1).join("");
  let satukata = hurufdepan + hurfubelakang.toLowerCase();

  return satukata;
}

document.getElementById("close-listcard").addEventListener('click', function() {
  body.style.overflow = "auto";
  btn_submit.setAttribute("data-submit", "no");
  black_screen.style.display = "none";
  list_card.style.display = "none";
})

function ambilLokasi() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(tampilkanPosisi);
  } else {
    console.log("Browser anda tidak mendukung");
  }
}

function tampilkanPosisi(Postion) {
  latitude = Postion.coords.latitude;
  longitude = Postion.coords.longitude;
//   document.querySelector("#frame").src = `https://maps.google.com/maps?q=${latitude},${longitude}&layer=c&z=17&sll=${latitude},${longitude}&cbp=13,276.3,0,0,0&cbll=${latitude},${longitude}&hl=en&ved=0CAoQ2wU&sa=X&output=svembed&layer=c`;
  ambilNamaJalan(latitude, longitude);
}

function ambilNamaJalan(lat, lng) {
  fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=3&q=${lat},${lng}&country=indonesia&addressdetails=1`)
    .then((respone) => respone.json())
    .then((respone) => {
        lokasi = respone[0].address.county.toUpperCase();
        document.getElementById("county").innerText = "DI " + lokasi;
        document.getElementById("format").value = lokasi;
        document.querySelector('.terdeteksi').style.display = 'flex';
      console.log(respone);
    });
}

document.getElementById('close-mesage').addEventListener('click', function() {
        document.querySelector(".terdeteksi").style.display = "none";
})

// btn.forEach((e) => {
//     e.addEventListener("click", function(){
//         if (e.getAttribute("data-status") === "none") {
//             e.setAttribute("data-status","clicked");
//             e.style.backgroundColor = "#269AD7";
//             e.style.color = "#fff";
//         }else if(e.getAttribute("data-status") === "clicked") {
//             e.setAttribute("data-status", "none");
//             e.style.backgroundColor = "#c0c0c0";
//             e.style.color = "#000";
//         }
//     })
// })

