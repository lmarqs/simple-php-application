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
        renderData(json.hits);
    });


function renderData(hits) {

    $tbody.html("");
    hits.forEach((hit) => {
        const {
            _source
        } = hit;

        const $row = $("<tr>");

        $row.append($("<td>", {
            text: _source.id
        }));

        $row.append($("<td>", {
            text: _source.name
        }));

        $row.append($("<td>", {
            text: _source.phone
        }));

        $row.append($("<td>", {
            text: _source.email
        }));

        $row.append($("<td>", {
            text: _source.birthday
        }));

        $row.append($("<td>")
            .append($("<a>", {
                href: `/contact/${_source.id}`,
                class: "btn btn-primary",
                text: "Edit"
            }))
            .append($("<a>", {
                href: `/contact/delete/${_source.id}`,
                class: "btn btn-danger",
                text: "Delete"
            })));

        $tbody.append($row);
    });
}