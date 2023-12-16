const formTotal = document.getElementById("post-total");
const formPeriode = document.getElementById("get-periode");

refreshpost();

formTotal.elements["tambahan"].addEventListener("keyup", cektambahan);
formTotal.elements["tambahan"].addEventListener("change", cektambahan);

function refreshpost() {
    const total = formTotal.elements["totalgaji"].value;

    const formatter = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    });
    formTotal.elements["totalview"].value = formatter.format(total);
}

function cektambahan(event) {
    (tambahan = parseInt(event.target.value)), event;
    if (isNaN(tambahan)) {
        event.target.value = 0;
        tambahan = 0;
    }
    const total_element = formTotal.elements["totalgaji"];
    const initial = parseInt(total_element.getAttribute("initial"));

    let total = initial + tambahan;
    total_element.value = total;

    refreshpost();
}
