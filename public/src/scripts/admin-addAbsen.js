var collumn = [];
let key;
refreshPertemuan();

//ADD PERTEMUAN
document
    .getElementById("btn-pertemuan-tambah")
    .addEventListener("click", function () {
        mapel = document.getElementById("mapel");
        mapell = mapel.options[mapel.selectedIndex].getAttribute("text");
        if (validationPertemuanInput() == true) {
            if (!isDateDuplicate(document.getElementById("tanggal").value)) {
                var newColumn = {
                    tanggal: document.getElementById("tanggal").value,
                    masuk: document.getElementById("masuk").value,
                    keluar: document.getElementById("keluar").value,
                };
                collumn.push(newColumn);
            } else {
                alert("Tanggal Telah Dijadwalkan! Masukkan Tanggal Lainnya");
            }
        }
        refreshPertemuan();
        kosongkan();
    });

function isDateDuplicate(newDate) {
    for (var i = 0; i < collumn.length; i++) {
        if (collumn[i].tanggal === newDate) {
            return true;
        }
    }
    return false;
}

//CHECK INPUT
function validationPertemuanInput() {
    let error;
    if (document.getElementById("mapel").value == "") {
        error = "Pastikan Mapel Telah Terisi!";
    } else if (!document.getElementById("tanggal").value) {
        error = "Pastikan Tanggal Telah Terisi!";
    } else if (!document.getElementById("masuk").value) {
        error = "Pastikan Waktu Masuk Telah Terisi!";
    } else if (!document.getElementById("keluar").value) {
        error = "Pastikan Keluar Telah Terisi!";
    } else if (
        document.getElementById("masuk").value >=
        document.getElementById("keluar").value
    ) {
        error = "Pastikan Waktu Masuk lebih awal daripada Waktu Keluar!";
    }

    if (error) {
        alert(error);
        return false;
    } else {
        return true;
    }
}

function editCollumnPertemuan(index) {
    var pertemuan = collumn[index];
    document.getElementById("id").value = index;
    document.getElementById("tanggal").value = pertemuan.tanggal;
    document.getElementById("masuk").value = pertemuan.masuk;
    document.getElementById("keluar").value = pertemuan.keluar;

    document.getElementById("btn-pertemuan-edit").removeAttribute("hidden");
    document
        .getElementById("btn-pertemuan-tambah")
        .setAttribute("hidden", true);
}

document
    .getElementById("btn-pertemuan-edit")
    .addEventListener("click", function () {
        index = document.getElementById("id").value;
        collumn[index]["tanggal"] = document.getElementById("tanggal").value;
        collumn[index]["masuk"] = document.getElementById("masuk").value;
        collumn[index]["keluar"] = document.getElementById("keluar").value;
        refreshCollumnPertemuan();
        kosongkan();
    });

document
    .getElementById("btn-pertemuan-kosong")
    .addEventListener("click", function () {
        kosongkan();
    });

function kosongkan() {
    document.getElementById("tanggal").value = null;
    document.getElementById("masuk").value = null;
    document.getElementById("keluar").value = null;
    document.getElementById("btn-pertemuan-tambah").removeAttribute("hidden");
    document.getElementById("btn-pertemuan-edit").setAttribute("hidden", true);
}

function deleteCollumnPertemuan(id) {
    collumn.splice(id, 1);
    refreshPertemuan();
}

function refreshPertemuan() {
    document.getElementById("pertemuan-table").innerHTML = "";

    let tag = '<table class="table stripe hover nowrap">';
    tag += "<thead>";
    tag += "<tr>";
    tag += '<th class="table-plus datatable-nosort text-center">No</th>';
    tag += '<th class="text-center">Mapel</th>';
    tag += '<th class="text-center">Tanggal</th>';
    tag += '<th class="text-center">Masuk</th>';
    tag += '<th class="text-center">Keluar</th>';
    tag += '<th class="text-center datatable-nosort">Action</th>';
    tag += "</tr>";
    tag += "</thead>";
    tag += '<tbody id="table-pertemuan-body"></tbody>';
    tag += "</table>";
    $("#pertemuan-table").append(tag);

    refreshCollumnPertemuan();
}

function refreshCollumnPertemuan() {
    mapel = document.getElementById("mapel");
    mapell = mapel.options[mapel.selectedIndex].getAttribute("text");

    document.getElementById("table-pertemuan-body").innerHTML = "";
    for (let index = 0; index < collumn.length; index++) {
        let tag = "<tr>";
        tag += '<td class="table-plus text-center">' + (index + 1) + "</td>";
        tag += '<td class="text-center">';
        tag += mapell;
        tag += "</td>";
        tag += '<td class="text-center">';
        tag += collumn[index]["tanggal"];
        tag +=
            '<input type="hidden" name="pertemuan[' +
            index +
            '][tanggal]" value="' +
            collumn[index]["tanggal"] +
            '">';
        tag += "</td>";
        tag += '<td class="text-center">';
        tag += collumn[index]["masuk"];
        tag +=
            '<input type="hidden" name="pertemuan[' +
            index +
            '][id_masuk]" value="' +
            collumn[index]["id_masuk"] +
            '">';
        tag +=
            '<input type="hidden" name="pertemuan[' +
            index +
            '][masuk]" value="' +
            collumn[index]["masuk"] +
            '">';
        tag += "</td>";
        tag += '<td class="text-center">';
        tag += collumn[index]["keluar"];
        tag +=
            '<input type="hidden" name="pertemuan[' +
            index +
            '][id_keluar]" value="' +
            collumn[index]["id_keluar"] +
            '">';
        tag +=
            '<input type="hidden" name="pertemuan[' +
            index +
            '][keluar]" value="' +
            collumn[index]["keluar"] +
            '">';
        tag += "</td>";
        tag += '<td class="text-center">';
        tag +=
            '<a class="btn btn-sm btn-outline-primary"  onclick="editCollumnPertemuan(' +
            index +
            ')">Edit</a>';
        tag +=
            '<a class="btn btn-sm btn-outline-primary"  onclick="deleteCollumnPertemuan(' +
            index +
            ')">Hapus</a>';
        tag += "</td></tr>";
        $("#table-pertemuan-body").append(tag);
    }
}
