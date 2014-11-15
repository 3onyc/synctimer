function formatDuration(duration, format) {
    if (format === undefined) {
        format = "%02d:%02d:%02d.%03d";
    }

    return sprintf(
        format,
        duration.asHours(),
        duration.minutes(),
        duration.seconds(),
        duration.milliseconds()
    );
}

module.exports = {
    formatDuration: formatDuration
};
