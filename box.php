<?php
$nav_items = [
    ['label' => 'Overview',    'icon' => 'compass', 'link' => 'index.php'],
    ['label' => 'Box Model',   'icon' => 'square',  'link' => 'box.php'],
    ['label' => 'Selectors',   'icon' => 'mouse-pointer-2', 'link' => 'selectors.php'],
    ['label' => 'Flexbox',     'icon' => 'columns', 'link' => 'flexbox.php'],
    ['label' => 'CSS Grid',    'icon' => 'grid',    'link' => 'css-grid.php'],
    ['label' => 'Final Project','icon' => 'layout', 'link' => 'project.php'],
];
$current_page = 'box.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Mastery | Box Model & Intro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root {
            --bg-main: #f9fafb;
            --sidebar-bg: #ffffff;
            --accent: #000000;
            --border-color: #e5e7eb;
            --sidebar-width: 280px;
        }

        body { font-family: 'Geist', sans-serif; background-color: var(--bg-main); margin: 0; overflow-x: hidden; transition: background 0.5s ease; }

        /* --- LAYOUT --- */
        .mobile-header { display: none; position: fixed; top: 0; left: 0; right: 0; height: 64px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border-color); z-index: 1100; padding: 0 1.25rem; align-items: center; justify-content: space-between; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; left: 0; top: 0; background: var(--sidebar-bg); border-right: 1px solid var(--border-color); padding: 2rem 1rem; z-index: 1200; transition: transform 0.3s ease; }
        .sidebar-overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 1150; }
        .sidebar-overlay.active { opacity: 1; visibility: visible; }
        .nav-link { color: #6b7280; padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 5px; display: flex; align-items: center; gap: 12px; text-decoration: none; font-weight: 500; }
        .nav-link.active { background: var(--accent); color: #fff !important; }
        .module-content { margin-left: var(--sidebar-width); padding: 4rem; max-width: 1200px; }

        /* --- INTRO STYLES --- */
        .intro-card { border-left: 5px solid #3b82f6 !important; }
        .code-block { background: #1e1e1e; color: #d4d4d4; padding: 1.5rem; border-radius: 12px; font-family: monospace; font-size: 0.9rem; }
        .css-prop { color: #9cdcfe; } .css-val { color: #ce9178; } .css-sel { color: #dcdcaa; }

        /* --- INTERACTIVE BOX --- */
        #box-preview-area { min-height: 300px; background: white; border-radius: 15px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; }
        #live-box { width: 120px; height: 120px; background: var(--accent); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; }

        @media (max-width: 992px) {
            .mobile-header { display: flex; }
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .module-content { margin-left: 0; padding: 6rem 1.25rem 2rem; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="overlay"></div>

    <header class="mobile-header d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
        <div class="d-flex align-items-center gap-2">
            <img src="smit.png" alt="SMIT Logo" width="28" height="28" class="rounded-1">
            <img src="it.jpeg" alt="BSIT Logo" width="28" height="28" class="rounded-1">
            <h6 class="fw-bold m-0" style="letter-spacing: -0.3px;">BSIT Project</h6>
        </div>

        <button class="btn p-2" id="menuBtn">
            <i data-lucide="menu"></i>
        </button>
    </header>
    
    <aside class="sidebar" id="sidebar">
        <div class="d-flex justify-content-between align-items-center mb-5 px-3">
            <div class="d-flex align-items-center gap-3">
                <img src="smit.png" alt="Logo" width="32" height="32" class="rounded-2 object-fit-cover">
                <img src="it.jpeg" alt="Logo" width="32" height="32" class="rounded-2 object-fit-cover">
                <h5 class="fw-bold m-0" style="letter-spacing: -0.5px;">BSIT Project</h5>
            </div>
            
            <button class="btn d-lg-none p-0" id="closeBtn">
                <i data-lucide="x"></i>
            </button>
        </div>
        <nav class="nav flex-column">
            <?php foreach ($nav_items as $item): ?>
                <a class="nav-link <?= ($current_page == $item['link']) ? 'active' : '' ?>" href="<?= $item['link'] ?>">
                    <i data-lucide="<?= $item['icon'] ?>" size="20"></i>
                    <?= $item['label'] ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </aside>

    <main class="module-content">
        <section class="card border-0 shadow-sm p-4 rounded-4 intro-card mb-5">
            <h1 class="display-6 fw-bold mb-3">What is CSS?</h1>
            <p class="text-muted"><strong>Cascading Style Sheets (CSS)</strong> is the language we use to style a Web page.</p>
            <ul class="list-unstyled mb-4">
                <li class="mb-2"><i data-lucide="check-circle" size="18" class="text-success me-2"></i> Describes how HTML elements are displayed on screen.</li>
                <li class="mb-2"><i data-lucide="check-circle" size="18" class="text-success me-2"></i> Saves work by controlling multiple pages at once.</li>
                <li class="mb-2"><i data-lucide="check-circle" size="18" class="text-success me-2"></i> Responsive design for different devices and screens.</li>
            </ul>

            <div class="code-block">
                <span class="css-sel">body</span> { <br>
                &nbsp;&nbsp;<span class="css-prop">background-color</span>: <span class="css-val">lightblue</span>; <br>
                } <br><br>
                <span class="css-sel">h1</span> { <br>
                &nbsp;&nbsp;<span class="css-prop">color</span>: <span class="css-val">white</span>; <br>
                &nbsp;&nbsp;<span class="css-prop">text-align</span>: <span class="css-val">center</span>; <br>
                }
            </div>
        </section>

        <section class="mb-4">
            <h2 class="fw-bold">The Box Model</h2>
            <p class="text-muted">Now that we know what CSS is, let's explore its most fundamental concept: Every element is a box.</p>
        </section>

        <div class="row g-4 align-items-start">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 rounded-4">
                    <div class="mb-4">
                        <label class="form-label d-flex justify-content-between">Padding <span id="p-val" class="text-primary">20px</span></label>
                        <input type="range" class="form-range" id="p-range" min="0" max="60" value="20">
                    </div>
                    <div class="mb-4">
                        <label class="form-label d-flex justify-content-between">Margin <span id="m-val" class="text-success">20px</span></label>
                        <input type="range" class="form-range" id="m-range" min="0" max="60" value="20">
                    </div>
                    <div class="mb-0">
                        <label class="form-label d-flex justify-content-between">Border <span id="b-val" class="text-danger">5px</span></label>
                        <input type="range" class="form-range" id="b-range" min="0" max="20" value="5">
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div id="box-preview-area">
                    <div id="box-container" style="border: 1px dashed #ccc;">
                        <div id="live-box">CONTENT</div>
                    </div>
                </div>
                <div class="mt-3 small text-center text-muted">
                    Total Width = Content + Padding + Border + Margin
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
        
        // Sidebar logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuBtn = document.getElementById('menuBtn');
        const closeBtn = document.getElementById('closeBtn');

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('active');
        }

        menuBtn.addEventListener('click', toggleSidebar);
        closeBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Box Model logic
        const pRange = document.getElementById('p-range');
        const mRange = document.getElementById('m-range');
        const bRange = document.getElementById('b-range');
        const liveBox = document.getElementById('live-box');

        function update() {
            const p = pRange.value;
            const m = mRange.value;
            const b = bRange.value;

            document.getElementById('p-val').innerText = p + 'px';
            document.getElementById('m-val').innerText = m + 'px';
            document.getElementById('b-val').innerText = b + 'px';

            liveBox.style.padding = `${p}px`;
            liveBox.style.margin = `${m}px`;
            liveBox.style.border = `${b}px solid #ef4444`;
        }

        [pRange, mRange, bRange].forEach(r => r.addEventListener('input', update));
        update();

        gsap.from(".module-content", { opacity: 0, y: 20, duration: 0.8 });
    </script>
</body>
</html>