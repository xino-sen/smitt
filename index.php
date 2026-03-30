<?php
$nav_items = [
    ['label' => 'Overview',    'icon' => 'compass', 'link' => 'index.php'],
    ['label' => 'Box Model',   'icon' => 'square',  'link' => 'box.php'],
    ['label' => 'Selectors',   'icon' => 'mouse-pointer-2', 'link' => 'selectors.php'],
    ['label' => 'Flexbox',     'icon' => 'columns', 'link' => 'flexbox.php'],
    ['label' => 'CSS Grid',    'icon' => 'grid',    'link' => 'css-grid.php'],
    ['label' => 'Final Project','icon' => 'layout', 'link' => 'project.php'],
];
$current_page = 'index.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Mastery | Overview</title>
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

        body { font-family: 'Geist', sans-serif; background-color: var(--bg-main); margin: 0; overflow-x: hidden; }

        /* --- MOBILE NAV LOGIC --- */
        .mobile-header {
            display: none; position: fixed; top: 0; left: 0; right: 0; height: 64px;
            background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color); z-index: 1100;
            padding: 0 1.25rem; align-items: center; justify-content: space-between;
        }

        .sidebar {
            width: var(--sidebar-width); height: 100vh; position: fixed; left: 0; top: 0;
            background: var(--sidebar-bg); border-right: 1px solid var(--border-color);
            padding: 2rem 1rem; z-index: 1200; transition: transform 0.3s ease;
        }

        .sidebar-overlay {
            position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4);
            opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 1150;
        }

        .sidebar-overlay.active { opacity: 1; visibility: visible; }

        .nav-link {
            color: #6b7280; padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 5px;
            display: flex; align-items: center; gap: 12px; text-decoration: none; font-weight: 500;
        }

        .nav-link.active { background: var(--accent); color: #fff !important; }

        .module-content { margin-left: var(--sidebar-width); padding: 4rem; max-width: 1200px; }

        .topic-card {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .topic-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
        }

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
        <h6 class="fw-bold m-0">BSIT Project</h6>
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
            <h1 class="display-5 fw-bold">CSS Mastery Path</h1>
            <p class="lead text-muted">From zero to layout hero. Select a module to begin.</p>
        </section>

        <div class="row g-4">
            <div class="col-md-6">
                <a href="box.php" class="card border-0 shadow-sm p-4 rounded-4 h-100 topic-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-dark text-white p-2 rounded-3"><i data-lucide="square"></i></div>
                        <h4 class="m-0">01. The Box Model</h4>
                    </div>
                    <p class="text-muted small">Learn how margins, borders, and padding define the size of every element on your page.</p>
                    <div class="mt-auto text-primary fw-bold small">Enter Module →</div>
                </a>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 opacity-75">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-secondary text-white p-2 rounded-3"><i data-lucide="mouse-pointer-2"></i></div>
                        <h4 class="m-0 text-muted">02. Selectors</h4>
                    </div>
                    <p class="text-muted small">Master the art of targeting elements with precision using classes, IDs, and pseudo-states.</p>
                    <span class="badge bg-light text-dark w-25">Coming Soon</span>
                </div>
            </div>
        </div>

        <section class="mt-5 border-top pt-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3>Why Master CSS?</h3>
                    <p class="text-muted">CSS is the skin and bone of the web. Without it, the internet is just a wall of plain text. Mastering layouts like Flexbox and Grid allows you to build interfaces that work on watches, phones, and 4K monitors alike.</p>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white p-4 rounded-4 shadow-sm border border-primary border-start-4">
                        <h6 class="fw-bold mb-1">Current Progress</h6>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-dark" style="width: 20%"></div>
                        </div>
                        <p class="small text-muted mt-2 mb-0">1 of 5 modules completed</p>
                    </div>
                </div>
            </div>
        </section>
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

        gsap.from(".module-content", { opacity: 0, y: 30, duration: 0.8 });
    </script>
</body>
</html>