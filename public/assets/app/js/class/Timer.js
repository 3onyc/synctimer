function Timer(name, type, target) {
    this.name = name;
    this.type = type;
    this.target = target;
}

Timer.prototype.getLocal = function() {
    return moment(this.target).local();
};

Timer.prototype.getDifference = function() {
    return moment.duration(Math.abs(this.target.diff(moment())));
};

Timer.prototype.isExpired = function() {
    if (this.type !== "countdown") {
        return false;
    }

    return moment().isAfter(this.target);
};

Timer.FromElement = function(elem) {
    var $elem = $(elem);

    return new Timer(
        $elem.data('timer-name'),
        $elem.data('timer-type'),
        moment.utc($elem.data('timer-target'))
    );
};

module.exports = Timer;
