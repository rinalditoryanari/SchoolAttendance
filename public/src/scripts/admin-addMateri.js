var materis = [];
refreshMateri();

//ADD materi
document
    .getElementById("btn-materi-tambah")
    .addEventListener("click", function () {
        let materi = document.getElementById("materi").value;
        console.log(materi);

        if (validationMateriInput() == true) {
            if (!isMateriDuplicate(materi)) {
                materis.push(materi);
            } else {
                alert("Ditemukan Materi Yang Sama! Masukkan Materi Lainnya");
            }
        }
        refreshMateri();
        kosongkan();
    });

function isMateriDuplicate(newMateri) {
    for (var i = 0; i < materis.length; i++) {
        if (materis[i] === newMateri) {
            return true;
        }
    }
    return false;
}

//CHECK INPUT
function validationMateriInput() {
    let error;
    if (document.getElementById("materi").value == "") {
        alert("Pastikan Materi Telah Terisi!");
        return false;
    } else {
        return true;
    }
}

function editCollumnMateri(index) {
    var materi = materis[index];
    document.getElementById("id-materi").value = index;
    document.getElementById("materi").value = materi;

    document.getElementById("btn-materi-edit").removeAttribute("hidden");
    document.getElementById("btn-materi-tambah").setAttribute("hidden", true);
}

document
    .getElementById("btn-materi-edit")
    .addEventListener("click", function () {
        index = document.getElementById("id").value;
        materis[index] = document.getElementById("materi").value;
        refreshCollumnMateri();
        kosongkan();
    });

document
    .getElementById("btn-materi-kosong")
    .addEventListener("click", function () {
        kosongkan();
    });

function kosongkan() {
    document.getElementById("id").value = null;
    document.getElementById("materi").value = null;
    document.getElementById("btn-materi-tambah").removeAttribute("hidden");
    document.getElementById("btn-materi-edit").setAttribute("hidden", true);
}

function deleteCollumnMateri(id) {
    materis.splice(id, 1);
    refreshMateri();
}

function refreshMateri() {
    document.getElementById("materi-table").innerHTML = "";

    let tag = '<table class="table stripe hover nowrap">';
    tag += "<thead>";
    tag += "<tr>";
    tag += '<th class="table-plus datatable-nosort text-center">No</th>';
    tag += '<th class="text-center">Materi</th>';
    tag += '<th class="text-center datatable-nosort">Action</th>';
    tag += "</tr>";
    tag += "</thead>";
    tag += '<tbody id="table-materi-body"></tbody>';
    tag += "</table>";
    $("#materi-table").append(tag);

    refreshCollumnMateri();
}

function refreshCollumnMateri() {
    document.getElementById("table-materi-body").innerHTML = "";
    for (let index = 0; index < materis.length; index++) {
        let tag = "<tr>";
        tag += '<td class="table-plus text-center">' + (index + 1) + "</td>";

        tag += '<td class="text-center">';
        tag += materis[index];
        tag +=
            '<input type="hidden" name="materi[' +
            index +
            ']" value="' +
            materis[index] +
            '">';
        tag += "</td>";

        tag += '<td class="text-center">';
        tag +=
            '<a class="btn btn-sm btn-outline-primary"  onclick="editCollumnMateri(' +
            index +
            ')">Edit</a>';
        tag +=
            '<a class="btn btn-sm btn-outline-primary"  onclick="deleteCollumnMateri(' +
            index +
            ')">Hapus</a>';
        tag += "</td></tr>";
        $("#table-materi-body").append(tag);
    }
}
