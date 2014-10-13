<article class="entry animated fadeInRight" id="favorites-container">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="entry-body" id="content-list">

				</div>                      
			</div>
		</div>
	</div>
</article>

<script>

	if(typeof(Storage) !== "undefined") {
		var favorites = localStorage.getItem('favorites'); 
		if(favorites == null) {
			favorites = new Array(); 

			localStorage.setItem('favorites', JSON.stringify(favorites)); 
		} else {
			favorites = JSON.parse(favorites);  
		}
	} else {
		console.log("*** Localstorage not supported."); 
	}


	var lookup = {};
	for (var i = 0, len = favorites.length; i < len; i++) {
	    lookup[favorites[i].room_name] = favorites[i];
	}

	console.log(lookup); 

	$.each(lookup, function(index, value) {
		var div = $('<div />')
		.addClass('favorite-element'); 

		var element1 = $('<h6>' + value.room_name + "</h6>"); 

		var list = $('<ul>')
		.addClass('list list-vertical'); 
		var element2 = $('<li><a href="#">' + value.object_name + '<span class="glyphicon glyphicon-chevron-right"></span></a></li>'); 

		list.append(element1)
		.append(element2); 

		div.append(element1).append(list); 
		$("#content-list").append(div); 
	}); 
</script>