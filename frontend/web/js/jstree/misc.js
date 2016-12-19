/* global jQuery */

// conditional select
(function ($, undefined) {
	"use strict";
	$.jstree.defaults.conditionalselect = function () {
		return true;
	};

	$.jstree.plugins.conditionalselect = function (options, parent) {
		// own function
		this.select_node = function (obj, supress_event, prevent_open) {
			if (this.settings.conditionalselect.call(this, this.get_node(obj))) {
				parent.select_node.call(this, obj, supress_event, prevent_open);
			}
		};
	};
})(jQuery);

// conditional activate
(function ($, undefined) {
	"use strict";
	$.jstree.defaults.onlyleafselect = {
		toggle_group: true
	};

	$.jstree.plugins.onlyleafselect = function (options, parent) {
		// own function
		this.activate_node = function (obj, e) {
			if (this.is_leaf(this.get_node(obj))) {
				parent.activate_node.call(this, obj, e);
			} else if (this.settings.onlyleafselect.toggle_group) {
				if (this.is_closed(obj)) {
					this.open_node(obj);
				} else {
					this.close_node(obj, false, 0);
				}
			}
		};
	};
})(jQuery);

