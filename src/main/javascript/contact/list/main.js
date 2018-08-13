import $ from "jquery";

const $content = $("#content");

const $table = $content.find("table");

const $tbody = $table.find("tbody");

$.ajax({
        method: "GET",
        url: "/api/contact"
    })
    .then((response) => {
        const json = JSON.parse(response);
        renderData(json.data);
    });


function renderData(data) {

    $tbody.html("");
    data.forEach((row) => {
        const $row = $("<tr>");

        $row.append($("<td>", {
            text: row.id,
            class: "text-center"
        }));

        $tbody.append($row);
    });
}
// private $id;
// private $name;
// private $phone;
// private $email;
// private $birthday;