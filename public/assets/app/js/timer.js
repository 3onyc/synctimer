window.SyncTimer.Timer = {};
window.SyncTimer.Timer.Edit = (function($) {
    function Init() {
        var $type = $("#type"),
            $target = $("#target-date"),
            $targetWrapper = $("#target-wrapper");

        function updateTargetVisibility()
        {
            if ($type.val() == "countdown") {
                $targetWrapper.show();
            } else {
                $targetWrapper.hide();
            }
        }

        updateTargetVisibility();
        $type.on('change', updateTargetVisibility);
        $target.fdatepicker({
            format: 'yyyy-mm-dd'
        });
    }

    return {
        Init: Init
    };
})(jQuery);

window.SyncTimer.Timer.View = (function($) {
    function Init() {
        var $name = $(".name"),
            $target = $(".target"),
            $targetDate = $(".target-iso"),
            $timer = $(".timer"),
            targetTime = moment.utc(window.targetTime);

        function formatDuration(duration) {
            return sprintf(
                "%02d:%02d:%02d.%03d",
                duration.asHours(),
                duration.minutes(),
                duration.seconds(),
                duration.milliseconds()
            );
        }

        function updateTimer() {
            var diff = Math.abs(targetTime.diff(moment())),
                duration = moment.duration(diff);

            $timer.text(formatDuration(duration));
        }

        // Scale text
        $name.fitText(1.4);
        $timer.fitText(0.8);
        $target.fitText(2.8);

        $targetDate.text(
            moment(targetTime).local().format("YYYY-MM-DD HH:mm:ss")
        );

        setInterval(updateTimer, 40);
    }

    return {
        Init: Init
    };
})(jQuery);
