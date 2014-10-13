<div id="chart_div" style="width: 100%; height: 500px;"></div>

<script type="text/javascript">

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

console.log(objects); 
var data = google.visualization.arrayToDataTable(objects);

var options = {
	title: 'Elförbrukning/dag',
	hAxis: {title: 'Datum', titleTextStyle: {color: '#ccc'}}, 
	vAxis: {title: 'kWh', titleTextStyle: {color: '#ccc'}}
};

var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
chart.draw(data, options);
</script>