/**
 * Created by danielzarate on 23/10/17.
 */

function loading(stat) {
    if (stat == 1) {
        $('#loading-area').removeClass('loading-off');
        $('#loading-area').removeClass('loading-on');
        $('body').addClass('modal-open');
    }
    if (stat == 0) {
        $('#loading-area').removeClass('loading-on');
        $('#loading-area').addClass('loading-off');
        $('body').removeClass('modal-open');
    }
}