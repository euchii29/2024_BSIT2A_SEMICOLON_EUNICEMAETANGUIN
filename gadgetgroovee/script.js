function openNav() {
    document.getElementById("sidebar").style.width = "250px";
    document.querySelector(".openbtn").classList.add("hidden");
}

function closeNav() {
    document.getElementById("sidebar").style.width = "0";
    document.querySelector(".openbtn").classList.remove("hidden");
}
