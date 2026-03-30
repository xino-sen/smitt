<?php
$nav_items = [
    ['label' => 'Overview',    'icon' => 'compass', 'link' => 'index.php'],
    ['label' => 'Box Model',   'icon' => 'square',  'link' => 'box.php'],
    ['label' => 'Selectors',   'icon' => 'mouse-pointer-2', 'link' => 'selectors.php'],
    ['label' => 'Flexbox',     'icon' => 'columns', 'link' => 'flexbox.php'],
    ['label' => 'CSS Grid',    'icon' => 'grid',    'link' => 'css-grid.php'],
    ['label' => 'Final Project','icon' => 'layout', 'link' => 'project.php'],
];
$current_page = 'selectors.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Mastery | Selectors Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root { --bg-main: #f9fafb; --sidebar-bg: #ffffff; --accent: #000000; --border-color: #e5e7eb; --sidebar-width: 280px; }
        body { font-family: 'Geist', sans-serif; background-color: var(--bg-main); margin: 0; overflow-x: hidden; }
        
        /* Mobile Header & Sidebar (Same as previous) */
        .mobile-header { display: none; position: fixed; top: 0; left: 0; right: 0; height: 64px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border-color); z-index: 1100; padding: 0 1.25rem; align-items: center; justify-content: space-between; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; left: 0; top: 0; background: var(--sidebar-bg); border-right: 1px solid var(--border-color); padding: 2rem 1rem; z-index: 1200; transition: transform 0.3s ease; }
        .sidebar-overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 1150; }
        .sidebar-overlay.active { opacity: 1; visibility: visible; }
        .nav-link { color: #6b7280; padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 5px; display: flex; align-items: center; gap: 12px; text-decoration: none; font-weight: 500; }
        .nav-link.active { background: var(--accent); color: #fff !important; }
        .module-content { margin-left: var(--sidebar-width); padding: 4rem; max-width: 1200px; }

        /* --- SELECTOR LAB STYLES --- */
        .html-preview { background: #1e1e1e; color: #d4d4d4; padding: 20px; border-radius: 12px; font-family: monospace; }
        .target-item { transition: all 0.3s ease; border: 2px solid transparent; padding: 10px; border-radius: 8px; margin-bottom: 10px; background: white; color: black; }
        .target-item.highlight { border-color: #3b82f6; box-shadow: 0 0 15px rgba(59, 130, 246, 0.5); transform: scale(1.02); }
        
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
        <section class="mb-5">
            <h1 class="display-6 fw-bold">CSS Selectors</h1>
            <p class="text-muted">The bridge between your HTML structure and your CSS design.</p>
        </section>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 rounded-4 mb-4">
                    <h5>Targeting Engine</h5>
                    <p class="small text-muted">Try typing these into the box:</p>
                    <ul class="small text-primary ps-3">
                        <li><code>.box</code> (Selects by class)</li>
                        <li><code>#special</code> (Selects by ID)</li>
                        <li><code>div</code> (Selects by tag)</li>
                    </ul>
                    <input type="text" id="selectorInput" class="form-control form-control-lg border-2" placeholder="e.g. .box">
                </div>

                <div class="card bg-dark text-white border-0 p-4 rounded-4">
                    <h6>Quick Reference</h6>
                    <table class="table table-dark table-sm small opacity-75 mb-0">
                        <tr><td><code>.name</code></td><td>Class Selector</td></tr>
                        <tr><td><code>#id</code></td><td>ID Selector</td></tr>
                        <tr><td><code>*</code></td><td>Universal Selector</td></tr>
                    </table>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="bg-light p-4 rounded-4 border">
                    <h6 class="text-uppercase small fw-bold text-muted mb-3">Live Result</h6>
                    <div id="sandbox">
                        <div class="target-item box" data-tag="div">Item 1 (Class: .box)</div>
                        <div class="target-item" id="special" data-tag="div">Item 2 (ID: #special)</div>
                        <div class="target-item box" data-tag="div">Item 3 (Class: .box)</div>
                        <p class="target-item mb-0" data-tag="p">Item 4 (Tag: p)</p>
                    </div>
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

        // Selector Lab Logic
        const input = document.getElementById('selectorInput');
        const sandbox = document.getElementById('sandbox');

        input.addEventListener('input', (e) => {
            const selector = e.target.value.trim();
            
            // Reset all highlights
            document.querySelectorAll('.target-item').forEach(el => el.classList.remove('highlight'));

            if (selector === "") return;

            try {
                // Try to find elements within the sandbox that match the selector
                const matches = sandbox.querySelectorAll(selector);
                matches.forEach(el => {
                    if (el.classList.contains('target-item')) {
                        el.classList.add('highlight');
                    }
                });
            } catch (err) {
                // Invalid selector, do nothing
            }
        });

        gsap.from(".module-content", { opacity: 0, x: -20, duration: 0.6 });
    </script>
</body>
</html>