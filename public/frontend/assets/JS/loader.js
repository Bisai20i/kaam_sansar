// File: public/frontend/assets/JS/loader.js

const LoaderManager = {
    loader: null,
    counter: 0,

    init() {
        if (!this.loader) {
            this.loader = document.getElementById('loader');
            if (!this.loader) {
                this.createLoader();
            }
        }
        this.handlePageLoads();
        this.handleAjaxRequests();
    },

    createLoader() {
        this.loader = document.createElement('div');
        this.loader.id = 'loader';
        this.loader.innerHTML = '<div class="spinner"></div>';
        document.body.appendChild(this.loader);
    },

    handlePageLoads() {
        window.addEventListener('beforeunload', () => {
            this.show();
        });

        window.addEventListener('load', () => {
            this.hide();
        });

        if (document.readyState === 'complete') {
            this.hide();
        }
    },

    handleAjaxRequests() {
        const originalFetch = window.fetch;
        window.fetch = async (...args) => {
            this.show();
            try {
                const response = await originalFetch(...args);
                return response;
            } finally {
                this.hide();
            }
        };

        const originalXHR = window.XMLHttpRequest;
        function newXHR() {
            const xhr = new originalXHR();
            xhr.addEventListener('loadstart', () => LoaderManager.show());
            xhr.addEventListener('loadend', () => LoaderManager.hide());
            return xhr;
        }
        window.XMLHttpRequest = newXHR;
    },

    show() {
        this.counter++;
        if (this.loader) {
            this.loader.style.display = 'flex';
        }
    },

    hide() {
        this.counter--;
        if (this.counter <= 0) {
            this.counter = 0;
            if (this.loader) {
                this.loader.style.display = 'none';
            }
        }
    }
};

// Initialize the loader manager
document.addEventListener('DOMContentLoaded', () => {
    LoaderManager.init();
});

// Handle form submissions
document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', () => {
            LoaderManager.show();
        });
    });
});