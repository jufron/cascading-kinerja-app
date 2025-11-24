// table summernote jadi responsive
document.addEventListener("DOMContentLoaded", function () {
    let content = document.querySelector(".summernote-content");

    if (content) {
        const allTables = content.querySelectorAll("table");

        allTables.forEach(function (table) {
            if (!table.parentElement.classList.contains("table-responsive")) {
                let wrapper = document.createElement("div");
                wrapper.style.overflowX = "auto";
                wrapper.classList.add("table-responsive");

                // Masukkan tabel ke dalam wrapper
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            }
        });
    }
});
