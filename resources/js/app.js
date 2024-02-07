import "./bootstrap";
import Inputmask from "inputmask";
import Alpine from "alpinejs";
window.Alpine = Alpine;

import AirDatepicker from "air-datepicker";
import "air-datepicker/air-datepicker.css";

new AirDatepicker(".datepicker", {
    timepicker: true,
    minDate: new Date(),
});
new AirDatepicker(".birthday", {
    timepicker: false,
});
$(".post__content").each(function () {
    let count = $(this).html().length;
    let text = "1 минута";
    if (count > 100) {
        text = "3 минуты";
    }
    if (count > 400) {
        text = "5 минут";
    }
    if (count > 700) {
        text = "больше 5 минут";
    }
    $(this)
        .find(".post__content-time")
        .html("Время чтения " + text);
});
$(".textarea").each(function () {
    let counter = $(this).find(".textarea__counter");
    let size = $(this).find("textarea").attr("maxlength");
    counter.text($(this).find("textarea")[0].value.length + "/" + size);
    $(this)
        .find("textarea")
        .keyup(function () {
            counter.text(this.value.length + "/" + size);
        });
});

const api = {
    posts: "/api/posts",
};
function padTo2Digits(num) {
    return num.toString().padStart(2, "0");
}

function formatDate(date) {
    return (
        padTo2Digits(date.getDate()) +
        "." +
        padTo2Digits(date.getMonth() + 1) +
        "." +
        date.getFullYear() +
        " " +
        date.getHours() +
        ":" +
        date.getMinutes()
    );
}

window.Alpine = Alpine;

Alpine.start();
var dt = new DataTransfer();
$(document).on("click", ".input-file-list-remove", function () {
    let name = $(this).prev().text();
    let input = $(this).closest(".input-file-row").find("input[type=file]");
    $(this).closest(".input-file-list-item").remove();
    for (let i = 0; i < dt.items.length; i++) {
        if (name === dt.items[i].getAsFile().name) {
            dt.items.remove(i);
        }
    }
    input[0].files = dt.files;
});

$(".input-file input[type=file]").on("change", function () {
    let $files_list = $(this).closest(".input-file").next();
    $files_list.empty();

    for (var i = 0; i < this.files.length; i++) {
        let file = this.files.item(i);
        dt.items.add(file);

        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = function () {
            let new_file_input =
                '<div class="input-file-list-item">' +
                '<img class="input-file-list-img" src="' +
                reader.result +
                '">' +
                '<span class="input-file-list-name">' +
                file.name +
                "</span>" +
                '<a href="#"  class="input-file-list-remove"></a>' +
                "</div>";
            $files_list.append(new_file_input);
        };
    }
    this.files = dt.files;
});

function imask() {
    Inputmask({ mask: "+7 999 999 99 99" }).mask("._mask-phone");
}
imask();
function renderHome(newurl = location.href) {
    let url = new URL(newurl);
    let page = url.searchParams.get("page");
    let sort = url.searchParams.get("sort");
    $.getJSON(api.posts, { page: page, sort: sort }, function (data) {
        console.log(data.next_page_url);
        let next =
            data.next_page_url != null
                ? `<a class="pagination__prev" href="${data.next_page_url}">Вперед »</a>`
                : `<a class="pagination__prev _disable" >Вперед »</a>`;
        let prev =
            data.prev_page_url != null
                ? `<a class="pagination__next" href="${data.prev_page_url}">« Назад</a>`
                : `<a class="pagination__next _disable" >« Назад</a>`;
        $(".pagination").html(`
    <div class="pagination__text">Показанно с ${data.from} по  ${data.to} из  ${data.total} результатов</div>
    <div class="pagination__wrap">${prev}${next}</div>
    `);
        $(".post-grid").html("");
        data.data.forEach((element) => {
            var d = new Date(element.delay);

            $(".post-grid").append(`
        <div class="post-preview" id="post-${element.id}">
						<div class="post-preview__img-wrap">
							<img  src="/storage/images/${element.photo}" alt="">	
						</div>
                       
						 <a  class="post-preview__link" href="/posts/${element.id}">${element.title}</a>
					    <p>${
                            element.description
                        }</p>  <div class="post-preview__date" >${formatDate(
                d
            )}</div>
                    </div>
    `);
        });
    });
}
if ($(".post-grid._ajax").length) {
    renderHome();
    $(document).on(
        "click",
        ".pagination__prev , .pagination__next",
        function (e) {
            e.preventDefault();
            renderHome($(this).attr("href"));
        }
    );
}
$(".home-sort").click(function () {
    var url_string = location.href;
    var url = new URL(url_string);
    $(".home-sort").attr(
        "sort",
        $(".home-sort").attr("sort") == "asc" ? "desc" : "asc"
    );
    url.searchParams.set("sort", $(".home-sort").attr("sort"));
    history.pushState({}, null, url.href);
    renderHome();
});
