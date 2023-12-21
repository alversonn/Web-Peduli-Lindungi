let seconds;
let minutes;
let hours;

let display;
let lamaWaktu;
let displaySeconds = 0;
let displayMinutes = 0;
let displayHours =  0;

let status = 'Stopped';
let interval = '';

let waktuAwal2;
let waktuSaatini2;

let waktuTerakhir;
let arr;
let jarakWaktu; 
let days;
let date_diff;
let jam;
const logo = document.querySelector(".logo");

logo.addEventListener("click", function () {
  document.location.href = "index.php";
});

const caption_main = document.querySelector('.caption-main'); 

function timeDiff(waktuAwal,waktuSaatini) {
	let jarak = waktuSaatini - waktuAwal;
	days = Math.floor(jarak / 1000 / 60 / (60 * 24));
	jam = Math.floor(jarak / 1000 / 60 /60);
	date_diff = new Date( jarak );
	hours = jam;
	minutes = date_diff.getMinutes();
	seconds = date_diff.getSeconds();
}

function StartWatch()
{
	seconds++;

	if(seconds/60 === 1)
	{
		seconds=0;
		minutes++;

		if(minutes/60 === 1)
		{
			minutes=0;
			hours++;
		}
	}

	if(seconds < 10 )
	{
		displaySeconds = '0' + seconds.toString();
	}
	else
	{
		displaySeconds = seconds;
	}

	if(minutes < 10 )
	{
		displayMinutes = '0' + minutes.toString();
	}
	else
	{
		displayMinutes = minutes;
	}

	if(hours < 10 )
	{
		displayHours = '0' + hours.toString();
	}
	else
	{
		displayHours = hours;
	}

	document.getElementById('display').innerText = displayHours + ":" + displayMinutes + ":" + displaySeconds;
	// display = hours +','+ minutes +','+ seconds;
	lamaWaktu = displayHours +':'+ displayMinutes +':'+ displaySeconds;
	document.getElementById('lama_perjalanan').value = lamaWaktu;
}

function play() {
	jarakWaktu = timeDiff(waktuAwal2,waktuSaatini2);
	interval = window.setInterval(StartWatch,1000);
	status = 'Started';
}

function stop() {
	window.clearInterval(interval);
	status = 'Stopped';
}

if(caption_main.childNodes[1].nodeName === 'H3') {
	stop();
}else {
	waktuAwal2 = new Date(waktuAwal).getTime();
    waktuSaatini2 = new Date(waktuSaatini).getTime();
	play();
}

function Reset()
{
	seconds = 0;
	hours = 0;
	minutes = 0;
	window.clearInterval(interval);
	document.getElementById('display').innerHTML = '00:00:00';
	status = 'Stopped';
}

window.onload = function(){

	if (window.location.href.split("#")[1] === "tentang") {
		window.scroll({
			top: 850,
			left: 0,
			behavior: "smooth",
    	});
  	} else if(window.location.href.split("#")[1] === "statistik") {
		window.scroll({
			top: 1550,
			left: 0,
			behavior: "smooth",
		});
	} else if(window.location.href.split("#")[1] === "beranda") {
		window.scroll({
			top: 0,
			left: 0,
			behavior: "smooth",
		});
	}

	var chart = new CanvasJS.Chart("chartContainer", {
	theme:"light2",
	animationEnabled: true,
	// axisY :{
	// 	title: "Jumlah Pasien",
	// },
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	data: [{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "## Pasien",
		name: "Terkonfirmasi",
        lineColor: "#269AD7",
		dataPoints: [
			{ label: "Depok", y: 175668 },
			{ label: "Bekasi", y: 175940 },
			{ label: "Jakarta", y: 1376074 },
			{ label: "Bogor", y: 63161 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "## Pasien",
		name: "Sembuh",
        lineColor: "mediumspringgreen",
		dataPoints: [
			{ label: "Depok", y: 164787 },
			{ label: "Bekasi", y: 135321 },
			{ label: "Jakarta", y: 1341152 },
			{ label: "Bogor", y: 61750 }
		]
	},
          {
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "## Pasien",
		name: "Meninggal",
        lineColor: "red",
		dataPoints: [
			{ label: "Depok", y: 2256 },
			{ label: "Bekasi", y: 1180 },
			{ label: "Jakarta", y: 15471 },
			{ label: "Bogor", y: 548 }
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	chart.render();
}



}


document.getElementById('tentang').addEventListener('click', function() {
	window.scroll({
		top: 850,
		left: 0,
		behavior: "smooth",
	});
})

document.getElementById("statistik").addEventListener("click", function() {
	window.scroll({
		top: 1550,
		left: 0,
		behavior: "smooth",
	});
})

document.getElementById("beranda").addEventListener("click", function() {
	window.scroll({
		top: 0,
		left: 0,
		behavior: "smooth",
	});
})