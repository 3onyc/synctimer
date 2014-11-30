var util = require('../util'),
    TimerRenderer = require('./TimerRenderer');

function BigTimerRenderer(timer, elem)
{
    TimerRenderer.call(this, timer, elem);
}

BigTimerRenderer.prototype = Object.create(TimerRenderer.prototype);

BigTimerRenderer.prototype.getTargetPrefix = function() {
    switch(this.timer.type) {
        case "stopwatch": return "Stopwatch Started At";
        case "countdown": return "Countdown To";
        default         : return "Unknown";
    }
};

BigTimerRenderer.prototype.setSizes = function() {
    this.$name.fitText(1.4);
    this.$timer.fitText(0.8);
    this.$target.fitText(2.8);
};

BigTimerRenderer.prototype.renderStatic = function() {
    TimerRenderer.prototype.renderStatic.call(this);

    this.setSizes();
    this.$target.text(this.getTargetPrefix() + " " + this.getFormattedTime());
};

module.exports = BigTimerRenderer;
