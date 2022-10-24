function isCalendlyEvent(e) {
    return e.origin === "https://calendly.com" && e.data.event && e.data.event.indexOf("calendly.") === 0;
};
setTimeout(function () {
    let iframe = $('.s-calendly__entity').find('iframe')
    if (iframe.length > 0) {
        window.addEventListener("message", function (e) {
            if (e.data.event == 'calendly.event_type_viewed') {
                $('.calendly-inline-widget.calendly-demo-call-decreased').height('630px');
            }
        });
    }
}, 2000);