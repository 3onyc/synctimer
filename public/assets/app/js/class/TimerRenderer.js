var util = require('../util');

function TimerRenderer(timer, elem, big)
{
    this.timer = timer;
	this.big = big;

    this.$name = $('.name', elem);
    this.$timer = $('.timer', elem);
    this.$target = $('.target', elem);
}

TimerRenderer.prototype.getTargetPrefix = function() {
    switch(this.timer.type) {
        case "stopwatch": return "Stopwatch Started At";
        case "countdown": return "Countdown To";
        default         : return "Unknown";
    }
};

TimerRenderer.prototype.getFormattedTime = function() {
    return this.timer.getLocal().format("YYYY-MM-DD HH:mm:ss");
};

TimerRenderer.prototype.setSizes = function() {
    this.$name.fitText(1.4);
    this.$timer.fitText(0.8);
    this.$target.fitText(2.8);
};

TimerRenderer.prototype.renderStatic = function() {
	if (this.big) {
		this.setSizes();
	}

    this.$name.text(this.timer.name);
    this.$target.text(this.getTargetPrefix() + " " + this.getFormattedTime());
};

TimerRenderer.prototype.render = function() {
    if (this.timer.isExpired()) {
        this.$timer.text(util.formatDuration(moment.duration()));
        return;
    }

    this.$timer.text(util.formatDuration(this.timer.getDifference()));
};

module.exports = TimerRenderer;
