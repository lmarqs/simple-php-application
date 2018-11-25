import $ from "jquery";

const $content = $("#content");

const $table = $content.find("table");
const $tbody = $table.find("tbody");

loadData();

/**
 * Load data from server and renders to screen
 * @returns {void}
 */
function loadData () {
    $tbody
        .empty()
        .html(`
            <tr class="text-center">
                <th colspan="6">Loading ...</th>
            </tr>
            `);

    const jqXHR = $.ajax({
        data: {
            q: $content.find("nav [name=q]").val(), // eslint-disable-line id-length, max-len
        },
        method: "GET",
        url: "/api/contact",
    });

    jqXHR
        .then((response) => {
            const json = JSON.parse(response);
            renderData(json.hits);
        })
        .catch(() => {
            renderData([]);
        });
}

/**
 * Delete a contact
 * @param {Number|string} id id of contact to be deleted
 * @returns {void}
 */
function deleteContact (id) {
    $.ajax({
        method: "DELETE",
        url: `/api/contact/${id}`,
    })
        .then(() => {
            loadData();
        });
}

/**
 * Renders hits to screen
 * @param {Array} hits records to be rendered
 * @returns {void}
 */
function renderData (hits) {
    $tbody
        .empty()
        .html(`
            <tr class="text-center">
                <th colspan="6">No data</th>
            </tr>
        `);

    hits.forEach((hit) => {
        const { _source } = hit;

        if (!_source.id) {
            return;
        }

        const $row = $("<tr>");

        ["id", "name", "phone", "email", "birthday"].forEach((prop) => {
            $row.append($("<td>", { text: _source[prop] }));
        });

        $row.append($("<td>")
            .append($("<a>", {
                class: "btn btn-primary",
                href: `/contact/${_source.id}`,
                text: "Edit",
            }))
            .append($("<a>", {
                class: "btn btn-secondary",
                data: {
                    id: _source.id,
                },
                on: {
                    click (event) {
                        deleteContact($(event.target).data("id"));
                    },
                },
                text: "Delete",
            })));

        $tbody.append($row);
    });
}
