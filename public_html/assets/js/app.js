(function($, window, document, undefined) {

	var pluginName = "hive",
		dataKey = "plugin_" + pluginName;

	var Plugin = function(element, options) {

		this.element = element;

		this.options = {
			nav: 		'#navbar-area', 
			content: 	'#content', 
		};

		this.init(options);
	};

	Plugin.prototype = {
		init: function(options) {
			$.extend(this.options, options);

			$placement = this.options.placement;

			this.element.css({
				"color": this.options.color,
				"background-color": this.options.background,
				"height": this.options.height,
				"width": this.options.width
			});

			this.onExit();
		},
		onExit: function() {

			var color = this.options.color;
			var background = this.options.background;
			var height = this.options.height;
			var width = this.options.width;
			var placement = this.options.placement;
			var message = this.options.message;

			window.onbeforeunload = function() {
				var dialog = document.createElement("div");
				document.body.appendChild(dialog);
				dialog.id = "dialog";
				dialog.style.background = background;
				dialog.style.color = color;
				dialog.style.height = height;
				dialog.style.width = width;
				if (placement === "bottom") {
					dialog.style.bottom = "0px";
					dialog.style.left = "0px";
				}
				else if (placement === "top" || placement === "left") {
					dialog.style.top = "0px";
					dialog.style.left = "0px";
				}
				else if (placement === "right") {
					dialog.style.top = "0px";
					dialog.style.right = "0px";
				}
				dialog.innerHTML = "<h1><a href='#'>"+message+"</a></h1>";
				$(dialog).css(
						"position", "absolute",
						"z-index", "-1"
						);
				return message;
			};
			// eg. show the currently configured message
			//console.log(this.options.placement);
		},
		color: function(vabandon) {
			this.options.color = vabandon;
			this.element.css("color", vabandon);
		},
		background: function(vabandon) {
			this.options.background = vabandon;
			this.element.css("background-color", vabandon);
		},
		height: function(vabandon) {
			this.options.height = vabandon;
			this.element.css("height", vabandon);
		},
		width: function(vabandon) {
			this.options.width = vabandon;
			this.element.css("width", vabandon);
		}
	};

	/*
	 * Plugin wrapper, preventing against multiple instantiations and
	 * return plugin instance.
	 */
	$.fn[pluginName] = function(options) {

		var plugin = this.data(dataKey);

		// has plugin instantiated ?
		if (plugin instanceof Plugin) {
			// if have options arguments, call plugin.init() again
			if (typeof options !== "undefined") {
				plugin.init(options);
			}
		} else {
			plugin = new Plugin(this, options);
			this.data(dataKey, plugin);
		}

		return plugin;
	};

}(jQuery, window, document));