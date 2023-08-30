const sections = ["cities", "airlines"];

sections.forEach(section => {
    if (window.location.href.includes(`/${section}`)) {
        document.querySelector(`a[href="${section}"]`).classList.add("shadow-md");
        return;
    }
});