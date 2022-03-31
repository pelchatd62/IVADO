jQuery(document).ready(function ($) {
    if ($(window).width() > 640) {
        var SEPARATION = 100; var AMOUNTX = 50; var AMOUNTY = 50;
        var container;
        var camera, scene, renderer;
        var particles; var particle; var count = 0;
        var mouseX = 660; var mouseY = -350;

        // OLD COLORS
        // var palegreen = 0x46A147;
        // var palered = 0xD0202E;
        // var paleyellow = 0xF2682A;
        // var paleblue = 0x0072BA;

        var paleblue = 0x0D92D4;
        var palegreen = 0x3EB08D;
        var darkgreen = 0x46AE70;
        var darkblue = 0x006CB7;
        var colors = [paleblue, palegreen, darkgreen, darkblue];

        var currentColor = 0;
        if ($('.homepage-hero:not(.in-header)')) {
            init();
            animate();
            $(document).on('DOMMouseScroll mousewheel', waveScrollPage);
        }

        function waveScrollPage() {
            if (!window.matchMedia('screen and (max-width: 1250px)').matches) {
                if (currentColor + 1 < colors.length) {
                    currentColor++;
                } else {
                    currentColor = 0;
                }

                for (var i = 0; i < scene.children.length; i++) {
                    scene.children[i].material.color.setHex(colors[currentColor]);
                }
            }
        }

        function init() {
            container = document.createElement('div', { id: 'particles', class: 'particles' });


            $('.homepage-hero:not(.in-header)').each(function () {
                $(this).append(container);
            });
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
            camera.position.z = 1000;
            scene = new THREE.Scene();
            particles = new Array();
            var material = new THREE.SpriteCanvasMaterial({
                color: colors[currentColor],
                program: function (context) {
                    context.beginPath();
                    context.moveTo(0, 0);
                    context.lineTo(0.3, 0.3);
                    context.lineTo(0.6, 0);
                    context.lineTo(0.3, -0.3);
                    context.closePath();
                    context.fill();
                }
            });

            var i = 0;
            for (var ix = 0; ix < AMOUNTX; ix++) {
                for (var iy = 0; iy < AMOUNTY; iy++) {
                    particle = particles[i++] = new THREE.Sprite(material);
                    particle.position.x = ix * SEPARATION - ((AMOUNTX * SEPARATION) / 2);
                    particle.position.z = iy * SEPARATION - ((AMOUNTY * SEPARATION) / 2);
                    // scene.background = new THREE.Color( 0x254a5d ); // UPDATED
                    scene.add(particle);
                }
            }
            renderer = new THREE.CanvasRenderer();
            renderer.setPixelRatio(window.devicePixelRatio);
            renderer = new THREE.CanvasRenderer({ alpha: true }); // gradient
            renderer.setSize(window.innerWidth, window.innerHeight);
            container.appendChild(renderer.domElement);

            //
            window.addEventListener('resize', onWindowResize, false);
        }

        function onWindowResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }

        function animate() {
            // eslint-disable-next-line no-undef
            requestAnimationFrame(animate);
            render();
        }
        function render() {
            camera.position.x += (mouseX - camera.position.x) * 0.05;
            camera.position.y += (-mouseY - camera.position.y) * 0.05;
            camera.lookAt(50, 400, null);

            var i = 0;
            for (var ix = 0; ix < AMOUNTX; ix++) {
                for (var iy = 0; iy < AMOUNTY; iy++) {
                    particle = particles[i++];
                    particle.position.y = (Math.sin((ix + count) * 0.3) * 50) +
                        (Math.sin((iy + count) * 0.5) * 50);
                    particle.scale.x = particle.scale.y = (Math.sin((ix + count) * 0.3) + 1) * 4 +
                        (Math.sin((iy + count) * 0.5) + 1) * 4;
                }
            }

            renderer.render(scene, camera);
            count += 0.03;
        }

    }
});
