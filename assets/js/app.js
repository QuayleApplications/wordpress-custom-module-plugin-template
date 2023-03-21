//Written in Vanilla JS
import {getEl, getEls, createEl, getAcfField, getTitleById, sleep } from './helpers.js';

document.addEventListener("DOMContentLoaded", () => {
    console.log('Hello World');

    let $q = jQuery.noConflict();
    $q(function(){
        'use strict';

        console.log('Hello from jQuery');
    });
});