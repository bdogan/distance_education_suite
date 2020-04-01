$.fn.realisticMenu = function() {

    // Hold global state
    let state = 'closed';

    // State Changer
    let stateChanger;
    const setState = function(_state){
        clearTimeout(stateChanger);
        stateChanger = setTimeout(() => {
            if (_state === state) return;
            state = _state;
        }, 10);
    }

    // Listen events
    return $(this).each(function(){
        $(this)
            .on('mouseenter', function() {
                if (state !== 'opened') return;
                $(this).closest('ul').find('li.show > a').dropdown('hide');
                $(this).dropdown('show');
            })
            .parent('li')
            .on('shown.bs.dropdown', () => setState('opened'))
            .on('hidden.bs.dropdown', () => setState('closed'));
    });
};
