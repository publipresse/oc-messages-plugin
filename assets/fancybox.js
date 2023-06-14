addEventListener('page:loaded', function() {
    openFancyboxPopup();
});

function openFancyboxPopup() {
    const popups = document.querySelectorAll('[data-fancybox-popup]');
    if(!popups.length) return;

    const groups = [];
    popups.forEach(function(el) {
        const alias = el.dataset.fancyboxPopup;
        if (!groups[alias]) {
            groups[alias] = [];
        }
        groups[alias].push(el);
    });

    Object.entries(groups).forEach(function([key, el]) {
        const gallery = [];
        el.forEach(function(el, key) {
            gallery[key] = {'src': el, 'type': 'inline'}
        });
        Fancybox.show(gallery, {
            backdropClick: 'next',
            on: {
                'close': (fancybox, slide) => {
                    oc.ajax(key+'::onClose', {});
                }
            }
        });
    });
}