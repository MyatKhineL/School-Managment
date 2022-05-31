/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// =========== Csrf token ===========
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": token.content,
        },
    });
} else {
    console.log("csrf token not found");
}

// =========== Data table Global ===========
$.extend(true, $.fn.dataTable.defaults, {
    processing: true,
    serverSide: true,
    responsive: true,
    mark: true,
    columnDefs: [
        {
            targets: "hidden",
            visible: false,
        },
        {
            targets: "no-sort",
            orderable: false,
        },
    ],
});
