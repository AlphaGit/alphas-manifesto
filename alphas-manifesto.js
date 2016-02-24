(function(document) {
    // helper functions, used to avoid jQuery as a dependency
    function onBodyReady(fn) {
        if (document.readyState != 'loading') {
            fn();
        } else if (document.addEventListener) { // IE9+
            document.addEventListener('DOMContentLoaded', fn);
        } else { // IE8
            document.attachEvent('onreadystatechange', function() {
                if (document.readyState != 'loading') fn();
            });
        }
    }

    function addEventListener(el, eventName, handler) {
      if (el.addEventListener) {
        el.addEventListener(eventName, handler);
      } else {
        el.attachEvent('on' + eventName, function(){
          handler.call(el);
        });
      }
    }

    // theme adjustments
    function adjustEmbedSizes() {
        var embeds = document.querySelectorAll('article iframe, article video, article embed');
        for (var i = 0; i < embeds.length; i++) {
            var embedded = embeds[i];
            var declaredWidth = +embedded.getAttribute('width');
            var declaredHeight = +embedded.getAttribute('height');
            if (!!declaredHeight && !!declaredWidth) {
                embedded.removeAttr('width');
            }
        }
    }

    function searchParentsByTag(element, upperTagName) {
        if (element.nodeName === upperTagName) return element;
        if (element.nodeName === 'WINDOW') return null;
        return searchParentsByTag(element.parentNode, upperTagName);
    }

    function searchBoxEventHandler(evt) {
        if (evt.which == 13) {
            evt.preventDefault();
            var closesForm = searchParentsByTag(evt.target, 'FORM');
            closesForm.submit();
        }            
    }

    function bindEnterToSearchBox() {
        var searchBoxes = document.querySelectorAll('.searchForm input.searchTerm');
        for (var i = 0; i < searchBoxes.length; i++) {
            var searchBox = searchBoxes[i];
            addEventListener(searchBox, 'keyup', searchBoxEventHandler);
        }
    }

    onBodyReady(adjustEmbedSizes);
    onBodyReady(bindEnterToSearchBox);
})(document);