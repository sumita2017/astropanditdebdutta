window.addEventListener("DOMContentLoaded", (event) => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki
    //changed
    const datatablesSimple = document.getElementById("datatablesSimple");
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
    const bannerdatatable = document.getElementById("bannerdatatable");
    if (bannerdatatable) {
        new simpleDatatables.DataTable(bannerdatatable);
    }

    const youtubedatatable = document.getElementById("youtubedatatable");
    if (youtubedatatable) {
        new simpleDatatables.DataTable(youtubedatatable);
    }

    const datatablereview = document.getElementById("datatablereview");
    if (datatablereview) {
        new simpleDatatables.DataTable(datatablereview);
    }

    const datatablezodiac = document.getElementById("datatablezodiac");
    if (datatablezodiac) {
        new simpleDatatables.DataTable(datatablezodiac);
    }

    const datatableappointment = document.getElementById("appointmenttable");
    if (datatableappointment) {
        new simpleDatatables.DataTable(datatableappointment);
    }

});
