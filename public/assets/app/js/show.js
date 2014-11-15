var Timer = require('./class/Timer'),
    BigTimerRenderer = require('./class/BigTimerRenderer');

$("div[data-timer]").each(function() {
    var timer = Timer.FromElement(this),
        timerRenderer = new BigTimerRenderer(timer);

    timerRenderer.run();
});
