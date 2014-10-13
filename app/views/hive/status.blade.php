<div id="chart_div" class="animated fadeInRight" style="width: 100%; height: 500px;"></div>

<article class="entry animated fadeInRight" id="no-objects">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 center">
				<h4>Lägg till åtminstone ett objekt för att kunna använda den här funktionen.</h4>
			</div>				
		</div>
	</div>
</article>

<script type="text/javascript">
$("#no-objects").hide(); 

if(typeof(Storage) !== "undefined") {
	var roomList = localStorage.getItem('roomList'); 
	var objects = new Array(); 
	objects.push(['Enhet', 'Elförbrukning', { role: 'style' }]); 

	if(roomList == null) {
		roomList = new Array(); 
	} else {
		roomList = JSON.parse(roomList); 
		$.each(roomList, function(index, val) {
			$.each(val.objects, function(index_obj, object) {
				var el = Math.round(((Math.random() * 2) + 1) * 10) / 10; 
				var back = ["#546E90","#768DC7","#626877"];
				var rand = back[Math.floor(Math.random() * back.length)];				
				objects.push([object.object_name, el, rand]); 
			}); 
		}); 
	}
} else {
	console.log("*** Localstorage not supported."); 
}

if(objects.length > 1) {
	console.log(objects); 
	var data = google.visualization.arrayToDataTable(objects);

	var options = {
		title: 'Elförbrukning/dag',
		hAxis: {title: 'Datum', titleTextStyle: {color: '#ccc'}}, 
		vAxis: {title: 'kWh', titleTextStyle: {color: '#ccc'}}
	};

	var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	chart.draw(data, options);
} else {
	$("#chart_div").hide(); 
	$("#no-objects").fadeIn(400); 
}
</script>