import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
// import html2canvas from 'hmtl2canvas';

window.Alpine = Alpine;
// window.html2canvas = html2canvas;

Alpine.plugin(focus);

Alpine.start();