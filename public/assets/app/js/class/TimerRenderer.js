var util = require('../util');

function TimerRenderer(timer, elem)
{
    this.timer = timer;

    this.$name = $('.name', elem);
    this.$timer = $('.timer', elem);
    this.$target = $('.target', elem);
}

TimerRenderer.prototype.getFormattedTime = function() {
    return this.timer.target.format("YYYY-MM-DD HH:mm:ss");
};

TimerRenderer.prototype.renderStatic = function() {
    this.$target.text(this.getFormattedTime());
    this.$name.text(this.timer.name);
};

TimerRenderer.prototype.render = function() {
    if (this.timer.isExpired()) {
        this.$timer.text(util.formatDuration(moment.duration()));
        return;
    }

    this.$timer.text(util.formatDuration(this.timer.getDifference()));
};

module.exports = TimerRenderer;
