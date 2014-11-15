var Timer = require('./Timer'),
    TimerRenderer = require('./TimerRenderer');

function MultiTimerRenderer()
{
	this.renderers = [];
	this.intervalHandler = null;
}

MultiTimerRenderer.fromPage = function() {
	var multiRenderer = new MultiTimerRenderer();

	$("*[data-timer]").each(function() {
		var timer = Timer.FromElement(this),
			renderer = new TimerRenderer(timer, this, $(this).is('[data-timer-big]'));

		multiRenderer.add(renderer);
	});

	return multiRenderer;
};

MultiTimerRenderer.prototype.add = function(renderer) {
	this.renderers.push(renderer);
};

MultiTimerRenderer.prototype.renderStatic = function() {
	$.each(this.renderers, function(idx, renderer) {
		renderer.renderStatic();
	});
};

MultiTimerRenderer.prototype.render = function() {
	$.each(this.renderers, function(idx, renderer) {
		renderer.render();
	});
};


MultiTimerRenderer.prototype.start = function() {
	this.renderStatic();

	setInterval(function(this$) {
		return function() {
			this$.render();
		};
	}(this), 42);
};

MultiTimerRenderer.prototype.stop = function() {
	clearInterval(this.intervalHandler);
	this.intervalHandler = null;
};

module.exports = MultiTimerRenderer;
