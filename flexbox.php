<?php
$nav_items = [
    ['label' => 'Overview',    'icon' => 'compass', 'link' => 'index.php'],
    ['label' => 'Box Model',   'icon' => 'square',  'link' => 'box.php'],
    ['label' => 'Selectors',   'icon' => 'mouse-pointer-2', 'link' => 'selectors.php'],
    ['label' => 'Flexbox',     'icon' => 'columns', 'link' => 'flexbox.php'],
    ['label' => 'CSS Grid',    'icon' => 'grid',    'link' => 'css-grid.php'],
    ['label' => 'Final Project','icon' => 'layout', 'link' => 'project.php'],
];
$current_page = 'flexbox.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Mastery | Flexbox Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root { --bg-main: #f9fafb; --sidebar-bg: #ffffff; --accent: #000000; --border-color: #e5e7eb; --sidebar-width: 280px; }
        body { font-family: 'Geist', sans-serif; background-color: var(--bg-main); margin: 0; overflow-x: hidden; }

        /* Mobile Layout Logic (Same as index/box) */
        .mobile-header { display: none; position: fixed; top: 0; left: 0; right: 0; height: 64px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border-color); z-index: 1100; padding: 0 1.25rem; align-items: center; justify-content: space-between; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; left: 0; top: 0; background: var(--sidebar-bg); border-right: 1px solid var(--border-color); padding: 2rem 1rem; z-index: 1200; transition: transform 0.3s ease; }
        .sidebar-overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 1150; }
        .sidebar-overlay.active { opacity: 1; visibility: visible; }
        .nav-link { color: #6b7280; padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 5px; display: flex; align-items: center; gap: 12px; text-decoration: none; font-weight: 500; }
        .nav-link.active { background: var(--accent); color: #fff !important; }
        .module-content { margin-left: var(--sidebar-width); padding: 4rem; max-width: 1200px; }

        /* --- FLEXBOX LAB STYLES --- */
        #flex-stage {
            background: #fff;
            border: 2px dashed #cbd5e1;
            border-radius: 16px;
            min-height: 300px;
            display: flex; /* The Magic */
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 15px;
        }

        .flex-item {
            width: 70px;
            height: 70px;
            background: var(--accent);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-weight: bold;
            margin: 5px;
            font-size: 1.2rem;
        }

        .control-group { background: white; padding: 20px; border-radius: 15px; border: 1px solid var(--border-color); }

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

    <header class="mobile-header">
        <h6 class="fw-bold m-0">ACADEMY.</h6>
        <button class="btn p-2" id="menuBtn"><i data-lucide="menu"></i></button>
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
        <section class="mb-4">
            <h1 class="display-6 fw-bold">Flexbox Layout</h1>
            <p class="text-muted">Align items in any direction with just a few lines of code.</p>
        </section>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="control-group shadow-sm mb-4">
                    <label class="fw-bold mb-3 d-block text-uppercase small letter-spacing">Justify Content</label>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-dark btn-sm active-flex" onclick="setFlex('justifyContent', 'flex-start', this)">flex-start</button>
                        <button class="btn btn-outline-dark btn-sm" onclick="setFlex('justifyContent', 'center', this)">center</button>
                        <button class="btn btn-outline-dark btn-sm" onclick="setFlex('justifyContent', 'flex-end', this)">flex-end</button>
                        <button class="btn btn-outline-dark btn-sm" onclick="setFlex('justifyContent', 'space-between', this)">space-between</button>
                        <button class="btn btn-outline-dark btn-sm" onclick="setFlex('justifyContent', 'space-around', this)">space-around</button>
                    </div>
                </div>

                <div class="control-group shadow-sm">
                    <label class="fw-bold mb-3 d-block text-uppercase small letter-spacing">Align Items</label>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-dark btn-sm active-flex" onclick="setFlex('alignItems', 'flex-start', this)">flex-start</button>
                        <button class="btn btn-outline-dark btn-sm" onclick="setFlex('alignItems', 'center', this)">center</button>
                        <button class="btn btn-outline-dark btn-sm" onclick="setFlex('alignItems', 'flex-end', this)">flex-end</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="p-3 bg-white border rounded-4 shadow-sm mb-3">
                    <div id="flex-stage">
                        <div class="flex-item">1</div>
                        <div class="flex-item">2</div>
                        <div class="flex-item">3</div>
                    </div>
                </div>
                <div class="card bg-dark text-info p-3 rounded-4 font-monospace small">
                    <span class="text-secondary">// Current CSS</span><br>
                    display: flex;<br>
                    justify-content: <span id="code-justify">flex-start</span>;<br>
                    align-items: <span id="code-align">flex-start</span>;
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
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

        // Flexbox logic
        const stage = document.getElementById('flex-stage');
        const codeJustify = document.getElementById('code-justify');
        const codeAlign = document.getElementById('code-align');

        function setFlex(property, value, btn) {
            // Apply style
            stage.style[property] = value;
            
            // Update code display
            if(property === 'justifyContent') codeJustify.innerText = value;
            if(property === 'alignItems') codeAlign.innerText = value;

            // Simple UI update: highlight active button in its group
            const parent = btn.parentElement;
            parent.querySelectorAll('.btn').forEach(b => b.classList.remove('btn-dark', 'text-white'));
            btn.classList.add('btn-dark', 'text-white');
        }

        // Initialize button states
        document.querySelectorAll('.active-flex').forEach(b => b.classList.add('btn-dark', 'text-white'));

        gsap.from(".module-content", { opacity: 0, scale: 0.98, duration: 0.6 });
    </script>
</body>
</html>