import $ from "jquery";

const $content = $("#content");

const $table = $content.find("table");
const $tbody = $table.find("tbody");

loadData();

function loadData() {
    $tbody
        .empty()
        .html(`
            <tr class="text-center">
                <th colspan="6">Loading ...</th>
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
        }).catch(() => {
            renderData([]);
        });

}


function renderData(hits) {

    $tbody.empty();

    if (!hits.length) {
        $tbody
            .empty()
            .html(`
                <tr class="text-center">
                    <th colspan="6">No data</th>
                </tr>
                `);
    }

    hits.forEach((hit) => {
        const {
            _source
        } = hit;

        if (!_source.id) {
            return;
        }

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
                class: "btn btn-secondary",
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