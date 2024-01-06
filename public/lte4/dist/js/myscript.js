$(document).ready(function () {
    // saveDokumenSisa('tesdong');
    // forgetDokumenSisa();
    // console.log(getDokumenSisa());
});

function getDokumenSisa() {
    return JSON.parse(localStorage.getItem("dokumen"));
}

function forgetDokumenSisa() {
    localStorage.clear()
}

function saveDokumenSisa(namaFile) {
    var dokSisaLama = getDokumenSisa();
    if (dokSisaLama != null) {
        dokSisaLama.push(namaFile);
        localStorage.setItem("dokumen", JSON.stringify(dokSisaLama));
    } else {
        dokSisaBaru = [namaFile];
        localStorage.setItem("dokumen", JSON.stringify(dokSisaBaru));
    }
}

function deleteDokumenSisa(namaFile) {
    var dokumenSisa = getDokumenSisa();
    if (dokumenSisa != null) {
        var posisi = dokumenSisa.indexOf(namaFile);
        if (posisi > -1) { // only splice array when item is found
            dokumenSisa.splice(posisi, 1); // 2nd parameter means remove one item only
            localStorage.setItem("dokumen", JSON.stringify(dokumenSisa));
        }
    }
}

function activeAdd(name) {
    var listItems = $("#list-sidebar li");
    listItems.each(function (i, li) {
        var a = $(li).find("a");
        var listItem = $(li).find("p");
        var html = $(listItem).html().toLowerCase();
        if (html.includes(name)) {
            $(a).addClass("active");
        }
    });
}

function activeRemove(name) {
    var listItems = $("#list-sidebar li");
    listItems.each(function (i, li) {
        var a = $(li).find("a");
        var listItem = $(li).find("p");
        var html = $(listItem).html().toLowerCase();
        if (html.includes(name)) {
            $(a).removeClass("active");
        }
    });
}

function menuOpen(name) {
    var listItems = $("#list-sidebar li");
    listItems.each(function (i, li) {
        var listItem = $(li).find("p");
        var html = $(listItem).html().toLowerCase();
        if (html.includes(name)) {
            $(li).addClass("menu-open");
        }
    });
}

function swalDelete(id, name, e) {
    swal({
        title: "Apa kamu yakin?",
        text: "Akan menghapus data dengan " + name + " and id " + id,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                e.submit();
            }
        });
}

function swalHapus(e) {
    swal({
        title: "Apa kamu yakin?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                e.submit();
            }
        });
}

function logout(event) {
    event.preventDefault();
    if (confirm("Apa kamu yakin ? ")) {
        document.getElementById('logout-form').submit();
    }
}