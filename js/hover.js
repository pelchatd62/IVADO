function watchForHover() {
    var hasHoverClass = false;
    var container = document.body;
    var lastTouchTime = 0;
    container.className += ' isTouch';
    function enableHover() {
        // filter emulated events coming from touch events
        if (new Date() - lastTouchTime < 500) return;
	        if (hasHoverClass) return;
	       container.className = container.className.replace(' isTouch', ' hasHover');
	        hasHoverClass = true;
    }
    function disableHover() {
        if (!hasHoverClass) return;
        container.className = container.className.replace(' hasHover', ' isTouch');
        hasHoverClass = false;
    }
    function updateLastTouchTime() {
        lastTouchTime = new Date();
    }
    document.addEventListener('touchstart', updateLastTouchTime, true);
    document.addEventListener('touchstart', disableHover, true);
    document.addEventListener('mousemove', enableHover, true);
    enableHover();
}

watchForHover();