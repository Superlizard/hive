<article class="entry animated fadeInRight" id="nav">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="entry-body entry-nav">
					<p href="#" class="btn-back" id="back"><span class="glyphicon glyphicon-chevron-left"></span> <span id="back-text">Tillbaka</span></p>
				</div>
			</div>
		</div>
	</div>
</article>

<article class="entry animated fadeInRight" id="rooms">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="entry-body">
					<ul class="list list-vertical" id="room-list">
					</ul>

					<ul class="list list-vertical">
						<li class="new-form">
							<input type="text" placeholder="Vilket rum är det?" class="form-control" style="margin-bottom: 4px;" id="room-name">
							<button type="button" class="btn btn-primary btn-block" id="add-room">Lägg till rum</button>
							<button type="button" class="btn btn-danger btn-block" id="cancel-room">Avbryt</button>
						</li>
						<li class="new"><a href="#" id="new-room"><span class="glyphicon glyphicon-plus-sign"></span> Lägg till rum <span class="glyphicon glyphicon-chevron-right"></span></a></li>
					</ul>
				</div>                      
			</div>
		</div>
	</div>
</article>

<article class="entry entry-hidden" id="objects">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="entry-body">
					<ul class="list list-vertical" id="object-list">
					</ul>
					<ul class="list list-vertical">
						<li class="new-form-object">
							<input type="text" placeholder="Vad är det för objekt?" class="form-control" style="margin-bottom: 4px;" id="object-name">
							<button type="button" class="btn btn-primary btn-block" id="add-object">Lägg till objekt</button>
							<button type="button" class="btn btn-danger btn-block" id="cancel-object">Avbryt</button>
						</li>
						<li class="new"><a href="#" id="new-object"><span class="glyphicon glyphicon-plus-sign"></span> Lägg till objekt <span class="glyphicon glyphicon-chevron-right"></span></a></li>
					</ul>
				</div>                      
			</div>
		</div>
	</div>
</article>

<article class="entry entry-hidden" id="single_object">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6">
				På/Av
			</div>
			<div class="col-xs-6 right">
				<input type="checkbox" id="on_off">
			</div>					
		</div>
		<div class="row">
			<div class="col-xs-6">
				Intensitet
			</div>
			<div class="col-xs-6 right">
				<div id="intensity"></div>
			</div>	
		</div>

		<div class="row">
			<div class="col-xs-12" id="favorites">
				<p class="btn btn-success" id="add-favorite">Lägg till som favorit</p>
			</div>				
		</div>		
	</div>
</article>

<script>
if(typeof(Storage) !== "undefined") {
	var roomList = localStorage.getItem('roomList'); 
	var favorites = localStorage.getItem('favorites'); 

	if(roomList == null) {
		roomList = new Array(); 
	} else {
		roomList = JSON.parse(roomList); 
		$.each(roomList, function(index, val) {
			var room_name = val.name; 
			var room = $('<li />'); 
			var link = $('<a />')
			.attr('href', '#'); 
			var content = $('<label class="label label-success">' + val.objects.length + '</label> ' + room_name + '<span class="glyphicon glyphicon-chevron-right"></span></a>');

			link.on('click', function() {
				buildRoom(room_name); 
			}); 			

			link.append(content); 
			room.append(link); 

			$("#room-list").prepend(room); 		
		}); 
	}

	if(favorites == null) {
		favorites = new Array();
		localStorage.setItem('favorites', JSON.stringify(favorites)); 
	} else {
		favorites = JSON.parse(favorites); 
	}
} else {
	console.log("*** Localstorage not supported."); 
}

$("#back").hide(); 
$(".new-form").hide(); 
$("#new-room").on('click', function() {
	$(this).fadeOut(200); 
	$(".new-form").fadeIn(200); 
});

$("#cancel-room").on('click', function() {
	$(".new-form").fadeOut(200); 
	$("#new-room").fadeIn(200); 
}); 

$("#add-room").on('click', function() {
	var room_name = $("#room-name").val(); 

	if(room_name.length == 0) {
		alert("Hallå där! Du måste lägga till ett namn på rummet."); 
		return; 
	}

	var room = $('<li />'); 
	var link = $('<a />')
	.attr('href', '#'); 
	var content = $('<label class="label label-success">0</label> '+ room_name +' <span class="glyphicon glyphicon-chevron-right"></span>');

	link.on('click', function() {
		buildRoom(room_name); 
	}); 

	link.append(content); 
	room.append(link); 

	// Localstorage
	storageRoom = {
		'name': room_name, 
		'objects': []
	}; 

	roomList.push(storageRoom); 
	localStorage.setItem('roomList', JSON.stringify(roomList)); 

	$("#room-list").prepend(room); 
	$(".new-form").fadeOut(100); 
}); 


var current_room = null; 
function buildRoom(room_name) {
	var lookup = {};
	for (var i = 0, len = roomList.length; i < len; i++) {
	    lookup[roomList[i].name] = roomList[i];
	}

	var room = lookup[room_name];
	current_room = room; 
	if(room) {
		$("#back").fadeIn(100); 
		$("#back-text").html(current_room.name); 
		$("#back").removeClass('disabled'); 
		$("#rooms").fadeOut(100); 
		$("#objects").fadeIn(200).addClass('animated fadeInRight'); 

		$("#object-list").empty(); 
		$.each(room.objects, function(index, value) {
			var object_name = value.object_name; 
			var object = $('<li />'); 
			var link = $('<a />')
			.attr('href', '#'); 

			if(value.on) {
				var content = '<span class="label label-success">På</span> '; 
			} else {
				var content = '<span class="label label-danger">Av</span> '; 
			}
			content += object_name + ' <span class="glyphicon glyphicon-chevron-right"></span>';

			link.on('click', function() {
				$("#back-text").html(current_room.name); 
				buildObject(value); 
			}); 

			link.append(content); 
			object.append(link); 

			$("#object-list").prepend(object); 			
		}); 
	}

	$("#back").on('click', function() {
		$("#objects").fadeOut(100); 
		$("#rooms").delay(100).fadeIn(200).addClass('animated fadeInRight'); 
		$(this).fadeOut(100); 
	}); 
}

$(".new-form-object").hide(); 
$("#new-object").on('click', function() {
	$(this).fadeOut(200); 
	$(".new-form-object").fadeIn(200); 
});

$("#cancel-object").on('click', function() {
	$(".new-form-object").fadeOut(200); 
	$("#new-object").fadeIn(200); 
}); 

$("#add-object").on('click', function() {
	var object_name = $("#object-name").val(); 

	if(object_name.length == 0) {
		alert("Hallå där! Du måste ange ett namn på objektet."); 
		return; 
	}

	var object = $('<li />'); 
	var link = $('<a />')
	.attr('href', '#'); 

	var content = '<span class="label label-danger">Av</span> '; 
	content += object_name + ' <span class="glyphicon glyphicon-chevron-right"></span>';

	link.append(content); 
	object.append(link); 

	// Localstorage
	storageObject = {
		'object_name': object_name, 
		'on': false, 
		'intensity': 0.0
	}; 

	link.on('click', function() {
		$("#back-text").html(current_room.name); 
		buildObject(storageObject); 
	}); 		

	current_room.objects.push(storageObject); 
	localStorage.setItem('roomList', JSON.stringify(roomList)); 

	$("#object-list").prepend(object); 
	$(".new-form-object").fadeOut(200); 
}); 

function buildObject(object) {
	$("#objects").fadeOut(100); 
	$("#back-text").html(object.object_name); 
	$("#single_object").delay(100).fadeIn(200).addClass('animated fadeInRight'); 

	$("#intensity").noUiSlider({
		start: [object.intensity]
	}, true); 


	if(object.on) {
		$("#on_off").attr('checked', 'checked'); 
	} else {
		$("#on_off").removeAttr('checked'); 
	}

	$("input[type=checkbox]").bootstrapSwitch();


	$("#on_off").on('switchChange.bootstrapSwitch', function(event, state) {
		object.on = state; 
	}); 

	$("#back").unbind('click'); 
	$("#back").on('click', function() {
		$("#single_object").fadeOut(100); 
		$("#objects").delay(100).fadeIn(200).addClass('animated fadeInRight'); 
		buildRoom(current_room.name); 

		$(this).unbind('click'); 
		$(this).on('click', function() {
			$("#objects").fadeOut(100); 
			$("#rooms").delay(100).fadeIn(200).addClass('animated fadeInRight');
			$("#back").addClass('disabled'); 

			$(this).unbind('click'); 
			$(this).hide(); 
		}); 
	}); 	

	$("#intensity").on({
		set: function() {
			object.intensity = $(this).val(); 
			localStorage.setItem('roomList', JSON.stringify(roomList)); 
		}
	})


	var lookup = {};
	for (var i = 0, len = favorites.length; i < len; i++) {
	    lookup[favorites[i].object_name] = favorites[i];
	}

	var this_object = lookup[object.object_name];

	if(this_object != null) {
		$("#add-favorite").html('Ta bort från favoriter')
		.removeClass('btn-success')
		.addClass('btn-danger'); 		
	} else {
		$("#add-favorite").html('Lägg till som favorit')
		.removeClass('btn-danger')
		.addClass('btn-success'); 
	}	

	$("#add-favorite").unbind('click'); 
	$("#add-favorite").on('click', function() {
		if(this_object != null) {
			$("#add-favorite").html('Lägg till som favorit')
			.removeClass('btn-danger')
			.addClass('btn-success'); 			


			var index = favorites.indexOf(this_object); 

			if (index > -1) {
			    favorites.splice(index, 1);
			}			
		} else {
			this_object = {
				object_name: object.object_name, 
				room_name: current_room.name
			}

			$("#add-favorite").html('Ta bort från favoriter')
			.removeClass('btn-success')
			.addClass('btn-danger'); 


			favorites.push(this_object); 
		}

		localStorage.setItem('favorites', JSON.stringify(favorites)); 
	}); 
}


$("#intensity").noUiSlider({
	start: [0.5],
	range: {
		'min': 0,
		'max': 1.0
	}
});	

</script>