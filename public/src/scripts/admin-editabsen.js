intitial();

function intitial() {
    data = document.getElementById("data").getAttribute("data");
    document.getElementById("data").setAttribute("data", "");
    if (data != null) {
        collumn = JSON.parse(data);
    } else {
        collumn = [];
    }
    console.log(collumn);
    refreshPertemuan();

    dataSecondary = document
        .getElementById("data")
        .getAttribute("data-secondary");
    document.getElementById("data").setAttribute("data-secondary", "");
    if (dataSecondary != null) {
        materis = JSON.parse(dataSecondary);
    } else {
        materis = [];
    }
    console.log(materis);
    refreshMateri();
}
