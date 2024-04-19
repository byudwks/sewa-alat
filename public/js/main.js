const sr = ScrollReveal({
    distance: "60px",
    duration: 2800,
    // reset: true,
});

sr.reveal(`.img-port`, {
    origin: "left",
    interval: 100,
});

sr.reveal(`.text-port`, {
    origin: "right",
    interval: 100,
});

sr.reveal(`.text-hero`, {
    origin: "top",
    interval: 100,
});

sr.reveal(`.layanan-1`, {
    origin: "bottom",
    interval: 100,
});
