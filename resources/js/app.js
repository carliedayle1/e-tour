import "./bootstrap";
import Alpine from "alpinejs";
import "flowbite";
import "flowbite-datepicker";
import DateRangePicker from "flowbite-datepicker/DateRangePicker";

window.Alpine = Alpine;

Alpine.start();

const dateRangePickerEl = document.getElementById("dateRangePickerId");
new DateRangePicker(dateRangePickerEl, {
    // options
});
