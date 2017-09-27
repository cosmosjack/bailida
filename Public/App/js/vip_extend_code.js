/**
 * Created by wh on 2017/9/26.
 */
document.querySelector('html').style.fontSize = window.screen.width / 10 + 'px';
window.onresize = function () {
    document.querySelector('html').style.fontSize = window.screen.width / 10 + 'px';
};