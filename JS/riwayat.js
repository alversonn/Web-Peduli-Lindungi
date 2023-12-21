const list_perjalanan = document.querySelectorAll('#list-perjalanan');
const list_perjalanan_content = document.querySelector('.list-perjalanan ul');
let lokasi = [];
const map = document.getElementById('map');
const back = document.getElementById('back');
const details = document.querySelector('.details');
const namaJalan = document.getElementById('namaJalan');
const waktuCheckin = document.getElementById('waktuCheckin');
const waktuCheckout = document.getElementById('waktuCheckout');
const lamaPerjalanan = document.getElementById('lamaPerjalanan');
const filter_lokasi = document.getElementById("filter-lokasi");
const logo = document.querySelector(".logo");

logo.addEventListener("click", function () {
  document.location.href = "index.php";
});

text.forEach(e => {
    lokasi.push(Object.values(e));
});

console.log(lokasi);

window.onload = function(){
    list_perjalanan.forEach((e, i) => {
        e.addEventListener('click', function() {
            console.log(this)
            // details.style.animation = 'slide 0.5s linear 0.5s forwards';
            
    
            // let id = this.attributes['data-id'].value;
            // lokasi.map(function(e){
            //     return e
            // }).filter(function(e){
            //     // console.log(e[0])
            //     if (e[0] === id){
            //         // console.log(e)
            //         let latitude = e[9]
            //         let longitude = e[10]
            //         map.src = `https://maps.google.com/maps?q=${latitude},${longitude}&ll${latitude},${longitude}&marker=${latitude},${longitude},${-40.755884},${73.978504}&spn=.0005,.0005&hl=en&output=embed`;
            //         namaJalan.innerText = e[6]
            //         waktuCheckin.innerText = e[5]
            //         waktuCheckout.innerText = e[7]
            //         lamaPerjalanan.innerText = e[8]
            //     }
            // })
        })
    })
}



back.addEventListener('click', function(){
    // alert('asu')
    details.style.animation = 'none';
})



$('#filter-lokasi').on('keyup', function(){
    // $(".list-perjalanan ul").load('search.php?keyword='+ $('#filter-lokasi').val());
    $.ajax({
        url : 'search.php',
        type : 'get',
        data : {
            'keyword' : $('#filter-lokasi').val()
        },
        success : function(res) {
            $(".list-perjalanan ul").html(res)
        }
    })
})

// let boxsearch = [];
// let li = [];

// filter_lokasi.addEventListener('input', function(){
//     lokasi.map(function (e) {
//         return e
//     }).forEach(function (e, i) {
        
//         let lokasi = e[6].toLocaleLowerCase();
//         let inputan = filter_lokasi.value.toLocaleLowerCase();
//         if (lokasi.includes(inputan)) {
//             console.log(e)
//             li.push( `<li id="list-perjalanan" data-id="${e[0]}">
//                             <img src="img/map.png" alt="" srcset="">
//                             <p>${e[6].substring(0, 55)}</p>
//                        </li>`);
//             list_perjalanan_content.innerHTML = li;
//         }else if (!filter_lokasi.value) {
//           li = [];
//           console.log("uuu");
//         }
//     })
//     console.log(li);


// })



// console.log(list_perjalanan)


// console.log(list_perjalanan_content)









