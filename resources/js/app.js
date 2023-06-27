import './bootstrap';
import select2 from 'select2';
import 'simplebar';
import 'metismenu';
import 'perfect-scrollbar';
import 'lightbox2';
import './dashboard/app.js';
import '@majidh1/jalalidatepicker/dist/jalalidatepicker.min';

select2();

jalaliDatepicker.startWatch();

toastr.options = {
    "debug": false,
    "positionClass": "toast-bottom-left",
}
