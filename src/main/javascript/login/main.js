import "./main.scss";
import $ from "jquery";
import cardImgTop from "./card-img-top.jpg";

const $content = $("#content");

$content.find(".card-img-top").prop("src", cardImgTop);
