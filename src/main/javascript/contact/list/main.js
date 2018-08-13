import $ from "jquery";

const $content = $("#content");

const $table = $content.find("table");
const $tbody = $table.find("tbody");

loadData();

function loadData() {
    $tbody
        .empty()
        .html(`
            <tr>
                <th colspan="5">Loading ...</th>
            </tr>
            `);

    $.ajax({
            method: "GET",
            url: "/api/contact",
            data: {
                q: $content.find("nav [name=q]").val()
            }
        })
        .then((response) => {
            const json = JSON.parse(response);
            renderData(json.hits);
        });

}


function renderData(hits) {

    $tbody.empty();
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

        window.console.log(hit);
        $row.append($("<td>")
            .append($("<a>", {
                href: `/contact/${_source.id}`,
                class: "btn btn-primary",
                text: "Edit"
            }))
            .append($("<a>", {
                class: "btn btn-danger",
                text: "Delete",
                data: {
                    id: _source.id
                },
                on: {
                    click(event) {
                        deleteContact($(event.target).data("id"));
                    }
                }
            })));

        $tbody.append($row);
    });
}

function deleteContact(id) {
    $.ajax({
            method: "DELETE",
            url: `/api/contact/${id}`
        })
        .then(() => {
            loadData();
        });
}