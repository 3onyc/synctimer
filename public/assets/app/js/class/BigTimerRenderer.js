var util = require('../util');

function BigTimerRenderer(timer, elem)
{
    this.timer = timer;

    this.$name = $('.name', elem);
    this.$timer = $('.timer', elem);
    this.$target = $('.target', elem);

    this.internalHandle = null;
}

BigTimerRenderer.prototype.getTargetPrefix = function() {
    switch(this.timer.type) {
        case "stopwatch": return "Stopwatch Started At";
        case "countdown": return "Countdown To";
        default         : return "Unknown";
    }
};

BigTimerRenderer.prototype.getFormattedTime = function() {
    return this.timer.getLocal().format("YYYY-MM-DD HH:mm:ss");
};

BigTimerRenderer.prototype.setSizes = function() {
    this.$name.fitText(1.4);
    this.$timer.fitText(0.8);
    this.$target.fitText(2.8);
};

BigTimerRenderer.prototype.renderStatic = function() {
    this.$name.text(this.timer.name);
    this.$target.text(this.getTargetPrefix() + " " + this.getFormattedTime());
};

BigTimerRenderer.prototype.render = function() {
    this.$timer.text(util.formatDuration(this.timer.getDifference()));
};

BigTimerRenderer.prototype.run = function() {
    this.setSizes();
    this.renderStatic();

    // Preserve 'this' as it's changed by setInterval
    this.intervalHandle = setInterval(function(this$) {
        return function() {
            this$.render();
        };
    }(this), 40);
};

BigTimerRenderer.prototype.stop = function() {
    if (this.intervalHandle !== null) {
        clearInterval(intervalHandle);
        this.intervalHandle = null;
    }
};

module.exports = BigTimerRenderer;
