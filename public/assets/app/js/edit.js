var SyncTimerEdit = (function($) {
    function Init() {
        var $type = $("#type"),
            $target = $("#target_date"),
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
