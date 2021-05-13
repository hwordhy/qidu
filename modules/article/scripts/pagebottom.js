document.write('<div class="copyright">作品本身仅代表作者本人的观点，与本站立场无关。如因而由此导致任何法律问题或后果，本站均不负任何责任。</div>');

document.oncontextmenu = function(){return false;};
document.ondragstart = function(){return false;};
document.onselectstart = function(){return false;};
document.onbeforecopy = function(){return false;};
document.onselect = function(){document.selection.empty();};
document.oncopy = function(){document.selection.empty();};
document.onmouseup = function(){document.selection.empty();};