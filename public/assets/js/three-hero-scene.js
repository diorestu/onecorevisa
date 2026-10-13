/**
 * OneCoreVisa - Interactive 3D Hero Scene (Three.js)
 * Features:
 *  - Procedural Balinese Split Gate (Gapura Bali / Candi Bentar)
 *  - Floating 3D Indonesian Biometric Passport Book with Gold Foil
 *  - Ambient Balinese Golden Sunset Atmosphere & Floating Dust Particles
 *  - Smooth Interactive Mouse Parallax & Gyro Movement
 *  - Performance Optimized (FPS throttle when offscreen via IntersectionObserver)
 */

(function () {
    'use strict';

    // Wait until DOM and THREE are loaded
    function initHero3D() {
        const container = document.getElementById('hero3dContainer');
        const canvas = document.getElementById('hero3dCanvas');
        if (!container || !canvas || typeof THREE === 'undefined') return;

        let width = container.clientWidth || 500;
        let height = container.clientHeight || 520;

        // 1. Scene, Camera, Renderer
        const scene = new THREE.Scene();

        const camera = new THREE.PerspectiveCamera(40, width / height, 0.1, 100);
        camera.position.set(0, 0.5, 7.8);

        const renderer = new THREE.WebGLRenderer({
            canvas: canvas,
            alpha: true,
            antialias: true,
            powerPreference: 'high-performance'
        });
        renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
        renderer.setSize(width, height);
        renderer.toneMapping = THREE.ACESFilmicToneMapping;
        renderer.toneMappingExposure = 1.15;

        // 2. Lighting Setup
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.9);
        scene.add(ambientLight);

        // Key Sun Light (Warm Bali Golden Hour)
        const sunLight = new THREE.DirectionalLight(0xffedd5, 1.6);
        sunLight.position.set(4, 7, 5);
        scene.add(sunLight);

        // Rim Light (Cyan / Sky Blue from behind-left for modern edge glow)
        const rimLight = new THREE.DirectionalLight(0x38bdf8, 1.4);
        rimLight.position.set(-5, 3, -4);
        scene.add(rimLight);

        // Warm Fill Light from below
        const fillLight = new THREE.PointLight(0xf59e0b, 1.0, 12);
        fillLight.position.set(0, -1.8, 3.5);
        scene.add(fillLight);

        // 3. Procedural Gapura Bali (Candi Bentar)
        const gateGroup = new THREE.Group();

        // Stone Materials
        const darkStoneMat = new THREE.MeshStandardMaterial({
            color: 0x1f242d,
            roughness: 0.72,
            metalness: 0.15
        });

        const accentStoneMat = new THREE.MeshStandardMaterial({
            color: 0x2e3644,
            roughness: 0.65,
            metalness: 0.22
        });

        const goldAccentMat = new THREE.MeshStandardMaterial({
            color: 0xdfab34,
            roughness: 0.32,
            metalness: 0.8
        });

        // Function to build one half of the Candi Bentar (Left Tower)
        function createGateHalf() {
            const half = new THREE.Group();

            // Plinth / Foundation Steps (Lower base)
            const base1 = new THREE.Mesh(new THREE.BoxGeometry(1.6, 0.25, 1.2), darkStoneMat);
            base1.position.set(-0.8, -1.8, 0);
            half.add(base1);

            const base2 = new THREE.Mesh(new THREE.BoxGeometry(1.4, 0.22, 1.0), accentStoneMat);
            base2.position.set(-0.7, -1.58, 0);
            half.add(base2);

            const base3 = new THREE.Mesh(new THREE.BoxGeometry(1.25, 0.2, 0.85), darkStoneMat);
            base3.position.set(-0.625, -1.38, 0);
            half.add(base3);

            // Gold band on base
            const baseGold = new THREE.Mesh(new THREE.BoxGeometry(1.27, 0.04, 0.87), goldAccentMat);
            baseGold.position.set(-0.625, -1.26, 0);
            half.add(baseGold);

            // Tier 1: Main lower body
            const body1 = new THREE.Mesh(new THREE.BoxGeometry(1.1, 0.9, 0.75), darkStoneMat);
            body1.position.set(-0.55, -0.8, 0);
            half.add(body1);

            // Carved horizontal relief stripes on Tier 1
            [-1.0, -0.8, -0.6].forEach(yPos => {
                const stripe = new THREE.Mesh(new THREE.BoxGeometry(1.12, 0.05, 0.77), accentStoneMat);
                stripe.position.set(-0.55, yPos, 0);
                half.add(stripe);
            });

            // Outer wing projection 1 (Sayap bawah)
            const wing1 = new THREE.Mesh(new THREE.BoxGeometry(0.35, 0.45, 0.5), accentStoneMat);
            wing1.position.set(-1.25, -0.85, 0);
            half.add(wing1);

            const wing1Tip = new THREE.Mesh(new THREE.ConeGeometry(0.18, 0.3, 4), goldAccentMat);
            wing1Tip.rotation.z = Math.PI / 4;
            wing1Tip.position.set(-1.42, -0.65, 0);
            half.add(wing1Tip);

            // Tier 2: Middle stepped section (narrower on outer side)
            const body2 = new THREE.Mesh(new THREE.BoxGeometry(0.95, 0.75, 0.65), darkStoneMat);
            body2.position.set(-0.475, 0.05, 0);
            half.add(body2);

            const tier2Gold = new THREE.Mesh(new THREE.BoxGeometry(0.97, 0.04, 0.67), goldAccentMat);
            tier2Gold.position.set(-0.475, -0.32, 0);
            half.add(tier2Gold);

            // Outer wing projection 2 (Sayap tengah)
            const wing2 = new THREE.Mesh(new THREE.BoxGeometry(0.3, 0.35, 0.4), accentStoneMat);
            wing2.position.set(-1.1, 0.05, 0);
            half.add(wing2);

            // Tier 3: Upper body
            const body3 = new THREE.Mesh(new THREE.BoxGeometry(0.8, 0.65, 0.55), darkStoneMat);
            body3.position.set(-0.4, 0.75, 0);
            half.add(body3);

            // Tier 4: Pinnacle base
            const body4 = new THREE.Mesh(new THREE.BoxGeometry(0.65, 0.55, 0.45), accentStoneMat);
            body4.position.set(-0.325, 1.35, 0);
            half.add(body4);

            // Tier 5: Steep top steps
            const body5 = new THREE.Mesh(new THREE.BoxGeometry(0.48, 0.45, 0.35), darkStoneMat);
            body5.position.set(-0.24, 1.85, 0);
            half.add(body5);

            // Crown Pinnacle (Sharp Meru spire with Gold finial)
            const crownStep = new THREE.Mesh(new THREE.BoxGeometry(0.32, 0.35, 0.25), accentStoneMat);
            crownStep.position.set(-0.16, 2.25, 0);
            half.add(crownStep);

            const crownPeak = new THREE.Mesh(new THREE.ConeGeometry(0.16, 0.5, 4), goldAccentMat);
            crownPeak.position.set(-0.08, 2.65, 0);
            half.add(crownPeak);

            return half;
        }

        // Left Tower
        const leftTower = createGateHalf();
        leftTower.position.x = -0.55;
        gateGroup.add(leftTower);

        // Right Tower (Mirrored by scaling x by -1)
        const rightTower = createGateHalf();
        rightTower.scale.x = -1;
        rightTower.position.x = 0.55;
        gateGroup.add(rightTower);

        // Ground Temple Terrace / Plinth Base Connecting Both
        const groundTerrace = new THREE.Mesh(
            new THREE.BoxGeometry(4.2, 0.15, 2.4),
            darkStoneMat
        );
        groundTerrace.position.set(0, -1.95, 0);
        gateGroup.add(groundTerrace);

        const groundTerraceUpper = new THREE.Mesh(
            new THREE.BoxGeometry(3.6, 0.12, 1.8),
            accentStoneMat
        );
        groundTerraceUpper.position.set(0, -1.82, 0);
        gateGroup.add(groundTerraceUpper);

        // Lower gateGroup slightly to frame center
        gateGroup.position.set(0, -0.15, -0.6);
        gateGroup.scale.set(0.95, 0.95, 0.95);
        scene.add(gateGroup);

        // 4. Procedural 3D Passport Book (Buku Passport)
        const passportGroup = new THREE.Group();

        // Generate Passport Front Cover Canvas Texture
        function createPassportCoverTexture() {
            const c = document.createElement('canvas');
            c.width = 512;
            c.height = 768;
            const ctx = c.getContext('2d');

            // Deep luxury navy leather background
            const bgGrad = ctx.createLinearGradient(0, 0, 512, 768);
            bgGrad.addColorStop(0, '#0c233c');
            bgGrad.addColorStop(0.5, '#071829');
            bgGrad.addColorStop(1, '#040e1a');
            ctx.fillStyle = bgGrad;
            ctx.fillRect(0, 0, 512, 768);

            // Subtle leatherette noise/vignette
            ctx.fillStyle = 'rgba(0,0,0,0.2)';
            ctx.fillRect(0, 0, 512, 768);

            // Gold Foil Ornaments
            ctx.strokeStyle = '#dfab34';
            ctx.lineWidth = 4;
            ctx.strokeRect(28, 28, 456, 712);

            ctx.lineWidth = 1.5;
            ctx.strokeRect(36, 36, 440, 696);

            // Ornamental Corner Accents
            const cornerSize = 24;
            [[42, 42], [470, 42], [42, 726], [470, 726]].forEach(([cx, cy]) => {
                ctx.fillStyle = '#f5c542';
                ctx.beginPath();
                ctx.arc(cx, cy, 4, 0, Math.PI * 2);
                ctx.fill();
            });

            // Text: REPUBLIK INDONESIA
            ctx.fillStyle = '#f5c542';
            ctx.textAlign = 'center';
            ctx.font = '700 24px "Poppins", sans-serif';
            ctx.letterSpacing = '5px';
            ctx.fillText('REPUBLIK INDONESIA', 256, 120);

            // Gold Garuda Pancasila Silhouette (Procedural Drawing)
            ctx.save();
            ctx.translate(256, 320);

            // Outer Shield / Wings
            ctx.fillStyle = '#f3ca52';
            ctx.beginPath();
            // Head & Crown
            ctx.arc(0, -65, 16, 0, Math.PI * 2);
            ctx.fill();

            // Beak
            ctx.beginPath();
            ctx.moveTo(12, -65);
            ctx.lineTo(26, -60);
            ctx.lineTo(12, -54);
            ctx.closePath();
            ctx.fill();

            // Wings Spread
            ctx.beginPath();
            ctx.moveTo(0, -40);
            // Left Wing
            ctx.quadraticCurveTo(-75, -80, -110, -20);
            ctx.quadraticCurveTo(-90, 10, -50, 40);
            // Right Wing
            ctx.lineTo(0, 30);
            ctx.lineTo(50, 40);
            ctx.quadraticCurveTo(90, 10, 110, -20);
            ctx.quadraticCurveTo(75, -80, 0, -40);
            ctx.closePath();
            ctx.fill();

            // Center Heart Shield
            ctx.fillStyle = '#b91c1c'; // Red shield half
            ctx.beginPath();
            ctx.moveTo(0, -35);
            ctx.lineTo(-32, -35);
            ctx.lineTo(-32, 5);
            ctx.quadraticCurveTo(0, 38, 0, 40);
            ctx.closePath();
            ctx.fill();

            ctx.fillStyle = '#f8fafc'; // White shield half
            ctx.beginPath();
            ctx.moveTo(0, -35);
            ctx.lineTo(32, -35);
            ctx.lineTo(32, 5);
            ctx.quadraticCurveTo(0, 38, 0, 40);
            ctx.closePath();
            ctx.fill();

            // Golden Star in center
            ctx.fillStyle = '#dfab34';
            ctx.beginPath();
            ctx.arc(0, -2, 9, 0, Math.PI * 2);
            ctx.fill();

            // Tail Feathers
            ctx.fillStyle = '#f3ca52';
            ctx.beginPath();
            ctx.moveTo(-25, 42);
            ctx.lineTo(0, 75);
            ctx.lineTo(25, 42);
            ctx.closePath();
            ctx.fill();

            // Ribbon: Bhinneka Tunggal Ika
            ctx.fillStyle = '#f8fafc';
            ctx.fillRect(-60, 52, 120, 12);
            ctx.restore();

            // Text: PASPOR / PASSPORT
            ctx.font = '800 32px "Poppins", sans-serif';
            ctx.letterSpacing = '6px';
            ctx.fillText('PASPOR', 256, 480);

            ctx.font = '600 20px "Poppins", sans-serif';
            ctx.letterSpacing = '5px';
            ctx.fillStyle = '#dfab34';
            ctx.fillText('PASSPORT', 256, 515);

            // Subtitle: ONECORE VISA GATEWAY
            ctx.font = '700 13px "Poppins", sans-serif';
            ctx.letterSpacing = '3px';
            ctx.fillStyle = '#38bdf8';
            ctx.fillText('ONECORE VISA • OFFICIAL GATEWAY', 256, 580);

            // Biometric e-Passport Chip Icon at bottom
            ctx.strokeStyle = '#f5c542';
            ctx.lineWidth = 3;
            ctx.strokeRect(228, 645, 56, 36);
            ctx.beginPath();
            ctx.arc(256, 663, 10, 0, Math.PI * 2);
            ctx.stroke();
            ctx.fillStyle = '#f5c542';
            ctx.fillRect(218, 660, 10, 6);
            ctx.fillRect(284, 660, 10, 6);

            const texture = new THREE.CanvasTexture(c);
            texture.generateMipmaps = true;
            texture.minFilter = THREE.LinearMipmapLinearFilter;
            return texture;
        }

        const coverTex = createPassportCoverTexture();

        // Passport Dimensions
        const pWidth = 1.62;
        const pHeight = 2.38;
        const pThickness = 0.22;

        // Cover Materials
        const frontCoverMat = new THREE.MeshStandardMaterial({
            map: coverTex,
            roughness: 0.35,
            metalness: 0.55
        });

        const backCoverMat = new THREE.MeshStandardMaterial({
            color: 0x071829,
            roughness: 0.45,
            metalness: 0.3
        });

        const spineMat = new THREE.MeshStandardMaterial({
            color: 0xdfab34, // Gold spine ribbon accent
            roughness: 0.3,
            metalness: 0.8
        });

        const pagesMat = new THREE.MeshStandardMaterial({
            color: 0xfbf8ee, // Cream luxury ivory paper edges
            roughness: 0.85,
            metalness: 0.05
        });

        // 1. Pages Block
        const pagesMesh = new THREE.Mesh(
            new THREE.BoxGeometry(pWidth - 0.08, pHeight - 0.08, pThickness - 0.04),
            pagesMat
        );
        pagesMesh.position.set(0.04, 0, 0);
        passportGroup.add(pagesMesh);

        // 2. Front Cover Mesh (Thick card with texture)
        const frontCoverGeo = new THREE.BoxGeometry(pWidth, pHeight, 0.024);
        // Multi-material to put texture on the front face (face index 4)
        const coverMaterials = [
            backCoverMat, // px
            backCoverMat, // nx
            backCoverMat, // py
            backCoverMat, // ny
            frontCoverMat, // pz (Front Face!)
            backCoverMat  // nz
        ];
        const frontCoverMesh = new THREE.Mesh(frontCoverGeo, coverMaterials);
        frontCoverMesh.position.set(0, 0, pThickness / 2);
        passportGroup.add(frontCoverMesh);

        // 3. Back Cover Mesh
        const backCoverMesh = new THREE.Mesh(
            new THREE.BoxGeometry(pWidth, pHeight, 0.024),
            backCoverMat
        );
        backCoverMesh.position.set(0, 0, -pThickness / 2);
        passportGroup.add(backCoverMesh);

        // 4. Spine (Golden book spine)
        const spineMesh = new THREE.Mesh(
            new THREE.CylinderGeometry(pThickness / 2, pThickness / 2, pHeight, 16),
            spineMat
        );
        spineMesh.position.set(-pWidth / 2, 0, 0);
        passportGroup.add(spineMesh);

        // Initial orientation & position of floating passport
        passportGroup.position.set(0, 0.1, 0.6);
        passportGroup.rotation.set(0.12, -0.32, 0.08);
        passportGroup.scale.set(1.12, 1.12, 1.12);
        scene.add(passportGroup);

        // 5. Ambient Floating Golden Particles (Bali twilight dust & sparkles)
        const particleCount = 75;
        const particleGeo = new THREE.BufferGeometry();
        const positions = new Float32Array(particleCount * 3);
        const speeds = new Float32Array(particleCount);

        for (let i = 0; i < particleCount; i++) {
            positions[i * 3] = (Math.random() - 0.5) * 6.5;
            positions[i * 3 + 1] = (Math.random() - 0.5) * 5.0;
            positions[i * 3 + 2] = (Math.random() - 0.5) * 4.0 + 1.0;
            speeds[i] = 0.2 + Math.random() * 0.5;
        }
        particleGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));

        const particleMat = new THREE.PointsMaterial({
            color: 0xfde047,
            size: 0.045,
            transparent: true,
            opacity: 0.75,
            blending: THREE.AdditiveBlending
        });
        const particles = new THREE.Points(particleGeo, particleMat);
        scene.add(particles);

        // 6. Interactive Mouse Tracking
        let mouseX = 0;
        let mouseY = 0;
        let targetMouseX = 0;
        let targetMouseY = 0;

        function onMouseMove(e) {
            const rect = container.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width;
            const y = (e.clientY - rect.top) / rect.height;
            targetMouseX = (x - 0.5) * 2;
            targetMouseY = (y - 0.5) * 2;
        }

        container.addEventListener('mousemove', onMouseMove);
        window.addEventListener('touchmove', function (e) {
            if (e.touches.length > 0) {
                const rect = container.getBoundingClientRect();
                const x = (e.touches[0].clientX - rect.left) / rect.width;
                const y = (e.touches[0].clientY - rect.top) / rect.height;
                targetMouseX = (x - 0.5) * 2;
                targetMouseY = (y - 0.5) * 2;
            }
        }, { passive: true });

        // 7. Animation Loop with Visibility Throttling
        let isVisible = true;
        let clock = new THREE.Clock();

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    isVisible = entry.isIntersecting;
                });
            }, { threshold: 0.1 });
            observer.observe(container);
        }

        function animate() {
            requestAnimationFrame(animate);

            if (!isVisible) return;

            const elapsedTime = clock.getElapsedTime();

            // Smooth Mouse Easing (Lerp)
            mouseX += (targetMouseX - mouseX) * 0.05;
            mouseY += (targetMouseY - mouseY) * 0.05;

            // Passport Dynamic Floating (Levitation sine-wave)
            const floatY = Math.sin(elapsedTime * 1.6) * 0.12;
            passportGroup.position.y = 0.12 + floatY;

            // Passport Rotation (Gentle breathing yaw + pitch + mouse response)
            passportGroup.rotation.y = -0.32 + Math.sin(elapsedTime * 0.9) * 0.1 + (mouseX * 0.35);
            passportGroup.rotation.x = 0.12 + Math.cos(elapsedTime * 1.2) * 0.05 + (-mouseY * 0.25);
            passportGroup.rotation.z = 0.06 + Math.sin(elapsedTime * 0.7) * 0.03;

            // Gate Subtle Parallax Shift
            gateGroup.rotation.y = mouseX * 0.12;
            gateGroup.rotation.x = -mouseY * 0.06;

            // Camera subtle breath
            camera.position.x = mouseX * 0.25;
            camera.position.y = 0.5 + (-mouseY * 0.18);
            camera.lookAt(0, 0.15, 0);

            // Animate Particles Drifting
            const posAttr = particleGeo.attributes.position;
            const posArr = posAttr.array;
            for (let i = 0; i < particleCount; i++) {
                posArr[i * 3 + 1] += speeds[i] * 0.008; // Drift upwards
                posArr[i * 3] += Math.sin(elapsedTime + i) * 0.002;
                if (posArr[i * 3 + 1] > 2.8) {
                    posArr[i * 3 + 1] = -2.2;
                }
            }
            posAttr.needsUpdate = true;

            renderer.render(scene, camera);
        }

        animate();

        // 8. Handle Window Resize
        function onResize() {
            if (!container) return;
            width = container.clientWidth || 500;
            height = container.clientHeight || 520;
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
            renderer.setSize(width, height);
        }

        window.addEventListener('resize', onResize);
    }

    // Auto-init on DOMContentLoaded or immediate if already ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHero3D);
    } else {
        initHero3D();
    }
})();
