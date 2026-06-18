<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menú Principal · Taller PHP</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --bg-deep: #050508;
    --bg-elevated: rgba(12, 12, 20, 0.6);
    --card-bg: rgba(20, 20, 35, 0.4);
    --border-soft: rgba(139, 92, 246, 0.15);
    --border-hover: rgba(139, 92, 246, 0.5);
    --violet: #8b5cf6;
    --violet-glow: rgba(139, 92, 246, 0.4);
    --violet-deep: #6d28d9;
    --cyan: #06b6d4;
    --cyan-glow: rgba(6, 182, 212, 0.3);
    --magenta: #e879f9;
    --amber: #fbbf24;
    --red: #f87171;
    --yellow: #fbbf24;
    --green: #34d399;
    --text-primary: #f1f5f9;
    --text-secondary: #94a3b8;
    --text-muted: #64748b;
    --glass: rgba(255, 255, 255, 0.03);
}

* { box-sizing: border-box; margin: 0; padding: 0; }

html { scroll-behavior: smooth; }

body {
    margin: 0;
    min-height: 100vh;
    font-family: 'Space Grotesk', sans-serif;
    color: var(--text-primary);
    background: var(--bg-deep);
    overflow-x: hidden;
    position: relative;
}

/* ===== CANVAS DE PARTÍCULAS ===== */
#particles-canvas {
    position: fixed;
    inset: 0;
    z-index: 0;
    pointer-events: none;
}

/* ===== FONDO CON GRADIENTES ORGÁNICOS ===== */
.bg-orb {
    position: fixed;
    border-radius: 50%;
    filter: blur(100px);
    opacity: 0.4;
    z-index: 0;
    pointer-events: none;
    animation: orb-float 20s ease-in-out infinite;
}

.orb-1 {
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(139,92,246,0.4), transparent 70%);
    top: -10%; left: -5%;
    animation-delay: 0s;
}

.orb-2 {
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(6,182,212,0.3), transparent 70%);
    top: 40%; right: -10%;
    animation-delay: -7s;
}

.orb-3 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(232,121,249,0.25), transparent 70%);
    bottom: -5%; left: 30%;
    animation-delay: -14s;
}

@keyframes orb-float {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(30px, -30px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.95); }
}

/* ===== GRID TIPO CÓDIGO ===== */
.code-grid {
    position: fixed;
    inset: 0;
    z-index: 1;
    pointer-events: none;
    background-image: 
        linear-gradient(rgba(139, 92, 246, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(139, 92, 246, 0.03) 1px, transparent 1px);
    background-size: 60px 60px;
    mask-image: radial-gradient(ellipse at 50% 0%, black 30%, transparent 80%);
    -webkit-mask-image: radial-gradient(ellipse at 50% 0%, black 30%, transparent 80%);
}

/* ===== CONTENEDOR PRINCIPAL ===== */
.contenedor {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 24px 100px;
}

/* ===== TERMINAL HEADER ===== */
.terminal {
    background: var(--bg-elevated);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid var(--border-soft);
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 60px;
    position: relative;
    box-shadow: 
        0 0 0 1px rgba(139, 92, 246, 0.1),
        0 25px 50px -12px rgba(0, 0, 0, 0.5),
        0 0 100px -20px rgba(139, 92, 246, 0.15);
    transition: box-shadow 0.4s ease;
}

.terminal::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--violet), transparent);
    opacity: 0.6;
}

.terminal:hover {
    box-shadow: 
        0 0 0 1px rgba(139, 92, 246, 0.2),
        0 25px 50px -12px rgba(0, 0, 0, 0.5),
        0 0 120px -20px rgba(139, 92, 246, 0.25);
}

.terminal__bar {
    display: flex;
    align-items: center;
    padding: 14px 20px;
    background: rgba(255, 255, 255, 0.02);
    border-bottom: 1px solid var(--border-soft);
    position: relative;
}

.dot {
    width: 12px; height: 12px;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    transition: transform 0.2s ease;
}

.dot::after {
    content: '';
    position: absolute;
    inset: -2px;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.dot--red { 
    background: var(--red); 
    box-shadow: 0 0 8px rgba(248, 113, 113, 0.4);
}
.dot--red::after { box-shadow: 0 0 12px rgba(248, 113, 113, 0.6); }

.dot--yellow { 
    background: var(--yellow); 
    margin-left: 8px;
    box-shadow: 0 0 8px rgba(251, 191, 36, 0.4);
}
.dot--yellow::after { box-shadow: 0 0 12px rgba(251, 191, 36, 0.6); }

.dot--green { 
    background: var(--green); 
    margin-left: 8px;
    box-shadow: 0 0 8px rgba(52, 211, 153, 0.4);
}
.dot--green::after { box-shadow: 0 0 12px rgba(52, 211, 153, 0.6); }

.terminal:hover .dot {
    transform: scale(1.1);
}

.terminal:hover .dot::after {
    opacity: 1;
}

.terminal__path {
    margin-left: 14px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.8rem;
    color: var(--text-muted);
    letter-spacing: 0.5px;
}

.terminal__body {
    padding: 40px 36px 44px;
    position: relative;
}

.terminal__line {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.92rem;
    color: var(--cyan);
    margin: 0 0 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.prompt {
    color: var(--violet);
    font-weight: 600;
    text-shadow: 0 0 10px rgba(139, 92, 246, 0.5);
}

.cursor {
    display: inline-block;
    width: 8px;
    height: 1.1em;
    background: var(--violet);
    margin-left: 2px;
    animation: blink 1s step-end infinite;
    box-shadow: 0 0 8px var(--violet-glow);
    vertical-align: text-bottom;
}

@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}

.terminal__body h1 {
    font-family: 'JetBrains Mono', monospace;
    font-weight: 800;
    letter-spacing: -1px;
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    margin: 0 0 12px;
    background: linear-gradient(135deg, var(--text-primary) 0%, var(--violet) 50%, var(--cyan) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}

.subtitle {
    margin: 0;
    color: var(--text-secondary);
    font-size: 1.05rem;
    font-weight: 400;
    max-width: 500px;
}

/* ===== LÍNEA DE CÓDIGO DECORATIVA ===== */
.code-line {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-top: 20px;
    opacity: 0.6;
}

.code-line .keyword { color: var(--magenta); }
.code-line .string { color: var(--green); }
.code-line .function { color: var(--amber); }

/* ===== GRID DE TARJETAS ===== */
.tarjetas {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    perspective: 1000px;
}

.card {
    display: flex;
    flex-direction: column;
    background: var(--card-bg);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid var(--border-soft);
    border-radius: 16px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    position: relative;
    transform-style: preserve-3d;
    transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1), 
                box-shadow 0.4s ease,
                border-color 0.4s ease;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.card::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 16px;
    padding: 1.5px;
    background: linear-gradient(135deg, transparent 40%, rgba(139, 92, 246, 0.3), transparent 60%);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}

.card::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--violet), transparent);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.card:hover,
.card:focus-visible {
    transform: translateY(-8px) rotateX(2deg);
    border-color: var(--border-hover);
    box-shadow: 
        0 25px 50px -12px rgba(0, 0, 0, 0.5),
        0 0 40px -10px var(--violet-glow),
        inset 0 1px 0 rgba(255, 255, 255, 0.05);
}

.card:hover::before,
.card:focus-visible::before {
    opacity: 1;
}

.card:hover::after,
.card:focus-visible::after {
    opacity: 0.6;
}

.card:focus-visible {
    outline: 2px solid var(--violet);
    outline-offset: 3px;
}

/* ===== TAB DE TARJETA ===== */
.card__tab {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    background: rgba(255, 255, 255, 0.02);
    border-bottom: 1px solid var(--border-soft);
    position: relative;
}

.card__tab::after {
    content: '';
    position: absolute;
    bottom: -1px; left: 16px; right: 16px;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--violet), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.card:hover .card__tab::after {
    opacity: 0.5;
}

.card__tab .dot {
    width: 10px; height: 10px;
}

.card__filename {
    margin-left: 10px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.72rem;
    color: var(--text-muted);
    transition: color 0.3s ease;
}

.card:hover .card__filename {
    color: var(--text-secondary);
}

/* ===== CUERPO DE TARJETA ===== */
.card__body {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 24px 22px 26px;
    position: relative;
}

.card__index {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.7rem;
    letter-spacing: 2px;
    color: var(--violet);
    font-weight: 600;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.card__index::before {
    content: '';
    display: inline-block;
    width: 20px;
    height: 2px;
    background: linear-gradient(90deg, var(--violet), transparent);
    border-radius: 2px;
}

.card__body h2 {
    margin: 0 0 12px;
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--text-primary);
    transition: color 0.3s ease;
}

.card:hover .card__body h2 {
    color: #fff;
}

.card__comment {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.82rem;
    line-height: 1.6;
    color: var(--cyan);
    margin: 0 0 28px;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.card:hover .card__comment {
    opacity: 1;
}

/* ===== BOTÓN EJECUTAR ===== */
.card__run {
    margin-top: auto;
    align-self: flex-start;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.82rem;
    font-weight: 600;
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--violet), var(--violet-deep));
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.card__run::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--cyan), var(--violet));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.card__run span {
    position: relative;
    z-index: 1;
}

.card:hover .card__run {
    transform: translateX(4px);
    box-shadow: 0 10px 30px -10px var(--violet-glow);
}

.card:hover .card__run::before {
    opacity: 1;
}

/* ===== NÚMERO DE LÍNEA DECORATIVO ===== */
.card__line-num {
    position: absolute;
    top: 24px; right: 22px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.65rem;
    color: var(--text-muted);
    opacity: 0.3;
}

/* ===== ANIMACIÓN DE ENTRADA ===== */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.terminal {
    animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
}

.card {
    opacity: 0;
    animation: fadeInUp 0.6s cubic-bezier(0.23, 1, 0.32, 1) forwards;
}

.card:nth-child(1) { animation-delay: 0.1s; }
.card:nth-child(2) { animation-delay: 0.2s; }
.card:nth-child(3) { animation-delay: 0.3s; }
.card:nth-child(4) { animation-delay: 0.4s; }
.card:nth-child(5) { animation-delay: 0.5s; }
.card:nth-child(6) { animation-delay: 0.6s; }
.card:nth-child(7) { animation-delay: 0.7s; }
.card:nth-child(8) { animation-delay: 0.8s; }

/* ===== RESPONSIVE ===== */
@media (max-width: 640px) {
    .tarjetas {
        grid-template-columns: 1fr;
    }
    
    .terminal__body {
        padding: 28px 22px 32px;
    }
    
    .terminal__body h1 {
        font-size: 1.6rem;
    }
}

@media (prefers-reduced-motion: reduce) {
    .cursor { animation: none; opacity: 1; }
    .bg-orb { animation: none; }
    .terminal, .card { animation: none; opacity: 1; }
}

/* ===== SCROLLBAR PERSONALIZADA ===== */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--bg-deep);
}

::-webkit-scrollbar-thumb {
    background: var(--border-soft);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--border-hover);
}
</style>

</head>

<body>

<!-- Fondos animados -->
<div class="bg-orb orb-1"></div>
<div class="bg-orb orb-2"></div>
<div class="bg-orb orb-3"></div>
<div class="code-grid"></div>
<canvas id="particles-canvas"></canvas>

<div class="contenedor">

    <!-- Terminal Header -->
    <header class="terminal">
        <div class="terminal__bar">
            <span class="dot dot--red"></span>
            <span class="dot dot--yellow"></span>
            <span class="dot dot--green"></span>
            <span class="terminal__path">~/taller-programacion.php — zsh — 80×24</span>
        </div>
        <div class="terminal__body">
            <p class="terminal__line">
                <span class="prompt">$</span>
                php taller.php --modo=interactivo
                <span class="cursor"></span>
            </p>
            <h1>Taller de Programación PHP</h1>
            <p class="subtitle">Selecciona un módulo para ejecutarlo en el entorno de desarrollo.</p>
            <div class="code-line">
                <span class="keyword">class</span> Taller { <span class="keyword">public function</span> <span class="function">iniciar</span>() { <span class="keyword">return</span> <span class="string">"¡Bienvenido!"</span>; } }
            </div>
        </div>
    </header>

    <!-- Grid de Tarjetas -->
    <main class="tarjetas">

        <a class="card" href="P1/index.php">
            <div class="card__tab">
                <span class="dot dot--red"></span>
                <span class="dot dot--yellow"></span>
                <span class="dot dot--green"></span>
                <span class="card__filename">P1.php</span>
            </div>
            <div class="card__body">
                <span class="card__line-num">01</span>
                <span class="card__index">P01</span>
                <h2>Potencias de un número</h2>
               
                <span class="card__run"><span>▶ Ejecutar</span></span>
            </div>
        </a>

        <a class="card" href="P2/index.php">
            <div class="card__tab">
                <span class="dot dot--red"></span>
                <span class="dot dot--yellow"></span>
                <span class="dot dot--green"></span>
                <span class="card__filename">P2.php</span>
            </div>
            <div class="card__body">
                <span class="card__line-num">02</span>
                <span class="card__index">P02</span>
                <h2>Suma del 1 al 1000</h2>
                
                <span class="card__run"><span>▶ Ejecutar</span></span>
            </div>
        </a>

        <a class="card" href="P3/index.php">
            <div class="card__tab">
                <span class="dot dot--red"></span>
                <span class="dot dot--yellow"></span>
                <span class="dot dot--green"></span>
                <span class="card__filename">P3.php</span>
            </div>
            <div class="card__body">
                <span class="card__line-num">03</span>
                <span class="card__index">P03</span>
                <h2>Multiplos de 4</h2>
               
                <span class="card__run"><span>▶ Ejecutar</span></span>
            </div>
        </a>

        <a class="card" href="P4/index.php">
            <div class="card__tab">
                <span class="dot dot--red"></span>
                <span class="dot dot--yellow"></span>
                <span class="dot dot--green"></span>
                <span class="card__filename">P4.php</span>
            </div>
            <div class="card__body">
                <span class="card__line-num">04</span>
                <span class="card__index">P04</span>
                <h2>Potencias de un número</h2>
               
                <span class="card__run"><span>▶ Ejecutar</span></span>
            </div>
        </a>

        <a class="card" href="P5/index.php">
            <div class="card__tab">
                <span class="dot dot--red"></span>
                <span class="dot dot--yellow"></span>
                <span class="dot dot--green"></span>
                <span class="card__filename">P5.php</span>
            </div>
            <div class="card__body">
                <span class="card__line-num">05</span>
                <span class="card__index">P05</span>
                <h2>Clasificación de Edades</h2>
                
                <span class="card__run"><span>▶ Ejecutar</span></span>
            </div>
        </a>

        <a class="card" href="P6/index.php">
            <div class="card__tab">
                <span class="dot dot--red"></span>
                <span class="dot dot--yellow"></span>
                <span class="dot dot--green"></span>
                <span class="card__filename">P6.php</span>
            </div>
            <div class="card__body">
                <span class="card__line-num">06</span>
                <span class="card__index">P06</span>
                <h2>Presupuesto Hospitalario</h2>
                
                <span class="card__run"><span>▶ Ejecutar</span></span>
            </div>
        </a>

        <a class="card" href="P7/index.php">
            <div class="card__tab">
                <span class="dot dot--red"></span>
                <span class="dot dot--yellow"></span>
                <span class="dot dot--green"></span>
                <span class="card__filename">P7.php</span>
            </div>
            <div class="card__body">
                <span class="card__line-num">07</span>
                <span class="card__index">P07</span>
                <h2>Área de un triángulo</h2>
                
                <span class="card__run"><span>▶ Ejecutar</span></span>
            </div>
        </a>
        <a class="card" href="P8/index.php">
            <div class="card__tab">
                <span class="dot dot--red"></span>
                <span class="dot dot--yellow"></span>
                <span class="dot dot--green"></span>
                <span class="card__filename">P8.php</span>
            </div>
            <div class="card__body">
                <span class="card__line-num">08</span>
                <span class="card__index">P08</span>
                <h2>Estación del año</h2>
                
                <span class="card__run"><span>▶ Ejecutar</span></span>
            </div>
        </a>

        <a class="card" href="P9/index.php">
            <div class="card__tab">
                <span class="dot dot--red"></span>
                <span class="dot dot--yellow"></span>
                <span class="dot dot--green"></span>
                <span class="card__filename">P9.php</span>
            </div>
            <div class="card__body">
                <span class="card__line-num">09</span>
                <span class="card__index">P09</span>
                <h2>Potencias de un número</h2>

                <span class="card__run"><span>▶ Ejecutar</span></span>
            </div>
        </a>

    </main>

</div>

<script>
// ===== SISTEMA DE PARTÍCULAS =====
const canvas = document.getElementById('particles-canvas');
const ctx = canvas.getContext('2d');

let width, height;
let particles = [];
const particleCount = 60;
const connectionDistance = 120;
const mouseDistance = 150;

let mouse = { x: null, y: null };

function resize() {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
}

window.addEventListener('resize', resize);
resize();

window.addEventListener('mousemove', (e) => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
});

window.addEventListener('mouseleave', () => {
    mouse.x = null;
    mouse.y = null;
});

class Particle {
    constructor() {
        this.x = Math.random() * width;
        this.y = Math.random() * height;
        this.vx = (Math.random() - 0.5) * 0.5;
        this.vy = (Math.random() - 0.5) * 0.5;
        this.size = Math.random() * 2 + 1;
        this.opacity = Math.random() * 0.5 + 0.2;
    }

    update() {
        this.x += this.vx;
        this.y += this.vy;

        if (this.x < 0 || this.x > width) this.vx *= -1;
        if (this.y < 0 || this.y > height) this.vy *= -1;

        // Interacción con el mouse
        if (mouse.x !== null && mouse.y !== null) {
            const dx = mouse.x - this.x;
            const dy = mouse.y - this.y;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < mouseDistance) {
                const force = (mouseDistance - distance) / mouseDistance;
                this.vx += (dx / distance) * force * 0.02;
                this.vy += (dy / distance) * force * 0.02;
            }
        }

        // Fricción
        this.vx *= 0.99;
        this.vy *= 0.99;
    }

    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(139, 92, 246, ${this.opacity})`;
        ctx.fill();
    }
}

function initParticles() {
    particles = [];
    for (let i = 0; i < particleCount; i++) {
        particles.push(new Particle());
    }
}

function animateParticles() {
    ctx.clearRect(0, 0, width, height);

    particles.forEach(particle => {
        particle.update();
        particle.draw();
    });

    // Dibujar conexiones
    for (let i = 0; i < particles.length; i++) {
        for (let j = i + 1; j < particles.length; j++) {
            const dx = particles[i].x - particles[j].x;
            const dy = particles[i].y - particles[j].y;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < connectionDistance) {
                const opacity = (1 - distance / connectionDistance) * 0.15;
                ctx.beginPath();
                ctx.moveTo(particles[i].x, particles[i].y);
                ctx.lineTo(particles[j].x, particles[j].y);
                ctx.strokeStyle = `rgba(139, 92, 246, ${opacity})`;
                ctx.lineWidth = 0.5;
                ctx.stroke();
            }
        }
    }

    requestAnimationFrame(animateParticles);
}

initParticles();
animateParticles();

// ===== EFECTO TILT 3D EN TARJETAS =====
const cards = document.querySelectorAll('.card');

cards.forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const rotateX = (y - centerY) / 20;
        const rotateY = (centerX - x) / 20;
        
        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = '';
    });
});
</script>

</body>
</html>