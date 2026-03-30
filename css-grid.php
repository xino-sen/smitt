<?php
$nav_items = [
    ['label' => 'Overview',    'icon' => 'compass', 'link' => 'index.php'],
    ['label' => 'Box Model',   'icon' => 'square',  'link' => 'box.php'],
    ['label' => 'Selectors',   'icon' => 'mouse-pointer-2', 'link' => 'selectors.php'],
    ['label' => 'Flexbox',     'icon' => 'columns', 'link' => 'flexbox.php'],
    ['label' => 'CSS Grid',    'icon' => 'grid',    'link' => 'css-grid.php'],
    ['label' => 'Final Project','icon' => 'layout', 'link' => 'project.php'],
];
$current_page = 'css-grid.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Mastery | Grid Garden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root { --bg-main: #f9fafb; --sidebar-bg: #ffffff; --accent: #000000; --border-color: #e5e7eb; --sidebar-width: 280px; }
        body { font-family: 'Geist', sans-serif; background-color: var(--bg-main); margin: 0; overflow-x: hidden; }

        /* Shared Mobile Layout */
        .mobile-header { display: none; position: fixed; top: 0; left: 0; right: 0; height: 64px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border-color); z-index: 1100; padding: 0 1.25rem; align-items: center; justify-content: space-between; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; left: 0; top: 0; background: var(--sidebar-bg); border-right: 1px solid var(--border-color); padding: 2rem 1rem; z-index: 1200; transition: transform 0.3s ease; }
        .sidebar-overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 1150; }
        .sidebar-overlay.active { opacity: 1; visibility: visible; }
        .nav-link { color: #6b7280; padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 5px; display: flex; align-items: center; gap: 12px; text-decoration: none; font-weight: 500; }
        .nav-link.active { background: var(--accent); color: #fff !important; }
        .module-content { margin-left: var(--sidebar-width); padding: 4rem; max-width: 1200px; }

        /* --- GRID STYLES --- */
        #grid-container {
            display: grid;
            gap: 15px;
            background: #fff;
            padding: 20px;
            border-radius: 20px;
            border: 2px dashed #cbd5e1;
            min-height: 400px;
            transition: all 0.5s ease;
        }

        .grid-item {
            background: var(--accent);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
            min-height: 80px;
        }

        .control-panel { background: white; border-radius: 15px; border: 1px solid var(--border-color); padding: 25px; }

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
            <h1 class="display-6 fw-bold">CSS Grid Layout</h1>
            <p class="text-muted">The most powerful layout system in CSS. Create complex 2D structures easily.</p>
        </section>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="control-panel shadow-sm">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Columns (grid-template-columns)</label>
                        <select class="form-select" id="colSelect" onchange="updateGrid()">
                            <option value="repeat(2, 1fr)">2 Columns (1fr 1fr)</option>
                            <option value="repeat(3, 1fr)" selected>3 Columns (1fr 1fr 1fr)</option>
                            <option value="1fr 2fr">Asymmetric (1fr 2fr)</option>
                            <option value="100px 1fr 100px">Fixed Sidebar (100px 1fr 100px)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Gap Spacing</label>
                        <input type="range" class="form-range" id="gapRange" min="0" max="50" value="15" oninput="updateGrid()">
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-dark rounded-pill" onclick="addItem()">+ Add Grid Item</button>
                    </div>
                </div>
                
                <div class="mt-4 card bg-dark text-success p-3 rounded-4 font-monospace small shadow-sm">
                    display: grid;<br>
                    grid-template-columns: <span id="code-cols" class="text-info">repeat(3, 1fr)</span>;<br>
                    gap: <span id="code-gap" class="text-info">15px</span>;
                </div>
            </div>

            <div class="col-lg-8">
                <div id="grid-container">
                    <div class="grid-item">1</div>
                    <div class="grid-item">2</div>
                    <div class="grid-item">3</div>
                    <div class="grid-item">4</div>
                    <div class="grid-item">5</div>
                    <div class="grid-item">6</div>
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

        // Grid Logic
        const container = document.getElementById('grid-container');
        const colSelect = document.getElementById('colSelect');
        const gapRange = document.getElementById('gapRange');
        
        function updateGrid() {
            const cols = colSelect.value;
            const gap = gapRange.value + 'px';

            container.style.gridTemplateColumns = cols;
            container.style.gap = gap;

            document.getElementById('code-cols').innerText = cols;
            document.getElementById('code-gap').innerText = gap;
        }

        function addItem() {
            const count = container.children.length + 1;
            const newItem = document.createElement('div');
            newItem.className = 'grid-item';
            newItem.innerText = count;
            container.appendChild(newItem);
            
            gsap.from(newItem, { scale: 0, opacity: 0, duration: 0.3 });
        }

        // Initialize
        updateGrid();
        gsap.from(".module-content", { opacity: 0, y: 30, duration: 0.7 });
    </script>
</body>
</html>