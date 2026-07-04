/*
|--------------------------------------------------------------------------
| Semáforo Contable
|--------------------------------------------------------------------------
*/

import './bootstrap';

import '../css/app.css';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

/*
|--------------------------------------------------------------------------
| Inicialización
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', () => {

    initializeTooltips();

    initializePopovers();

    initializeConfirmActions();

    initializeAutoCloseAlerts();

});

/*
|--------------------------------------------------------------------------
| Tooltips
|--------------------------------------------------------------------------
*/

function initializeTooltips() {

    document
        .querySelectorAll('[data-bs-toggle="tooltip"]')
        .forEach(element => {

            new bootstrap.Tooltip(element);

        });

}

/*
|--------------------------------------------------------------------------
| Popovers
|--------------------------------------------------------------------------
*/

function initializePopovers() {

    document
        .querySelectorAll('[data-bs-toggle="popover"]')
        .forEach(element => {

            new bootstrap.Popover(element);

        });

}

/*
|--------------------------------------------------------------------------
| Confirmaciones
|--------------------------------------------------------------------------
*/

function initializeConfirmActions() {

    document
        .querySelectorAll('[data-confirm]')
        .forEach(button => {

            button.addEventListener('click', function (event) {

                if (!confirm(this.dataset.confirm)) {

                    event.preventDefault();

                }

            });

        });

}

/*
|--------------------------------------------------------------------------
| Alertas
|--------------------------------------------------------------------------
*/

function initializeAutoCloseAlerts() {

    document
        .querySelectorAll('.alert.auto-close')
        .forEach(alert => {

            setTimeout(() => {

                bootstrap
                    .Alert
                    .getOrCreateInstance(alert)
                    .close();

            }, 4000);

        });

}