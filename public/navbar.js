const sections = ["cities", "airlines", "flights"];

sections.forEach(section => {
    if (window.location.href.includes(`/${section}`)) {
        document.querySelector(`a[href="${section}"]`).classList.add("shadow-md");
        return;
    }
});