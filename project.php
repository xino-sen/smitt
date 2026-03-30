<?php
$nav_items = [
    ['label' => 'Overview',    'icon' => 'compass', 'link' => 'index.php'],
    ['label' => 'Box Model',   'icon' => 'square',  'link' => 'box.php'],
    ['label' => 'Selectors',   'icon' => 'mouse-pointer-2', 'link' => 'selectors.php'],
    ['label' => 'Flexbox',     'icon' => 'columns', 'link' => 'flexbox.php'],
    ['label' => 'CSS Grid',    'icon' => 'grid',    'link' => 'css-grid.php'],
    ['label' => 'Final Project','icon' => 'layout', 'link' => 'project.php'],
];
$current_page = 'project.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Mastery | Final Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root { --bg-main: #f9fafb; --sidebar-bg: #ffffff; --accent: #000000; --border-color: #e5e7eb; --sidebar-width: 280px; }
        body { font-family: 'Geist', sans-serif; background-color: var(--bg-main); margin: 0; overflow-x: hidden; }

        /* Sidebar & Mobile Header (Standardized) */
        .mobile-header { display: none; position: fixed; top: 0; left: 0; right: 0; height: 64px; background: rgba(255,255,255,0.9); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border-color); z-index: 1100; padding: 0 1.25rem; align-items: center; justify-content: space-between; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; left: 0; top: 0; background: var(--sidebar-bg); border-right: 1px solid var(--border-color); padding: 2rem 1rem; z-index: 1200; transition: transform 0.3s ease; }
        .nav-link { color: #6b7280; padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 5px; display: flex; align-items: center; gap: 12px; text-decoration: none; font-weight: 500; }
        .nav-link.active { background: var(--accent); color: #fff !important; }
        .module-content { margin-left: var(--sidebar-width); padding: 4rem; max-width: 1200px; }

        /* --- PROJECT PREVIEW STYLES --- */
        .project-window { background: white; border: 1px solid #ddd; border-radius: 12px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .browser-bar { background: #f1f5f9; padding: 10px 15px; display: flex; gap: 6px; border-bottom: 1px solid #ddd; }
        .dot { width: 10px; height: 10px; border-radius: 50%; background: #cbd5e1; }
        
        /* The "Site" inside the preview */
        #site-nav { display: flex; justify-content: space-between; padding: 1rem 2rem; border-bottom: 1px solid #eee; align-items: center; }
        #site-hero { padding: 4rem 2rem; text-align: center; background: #fafafa; }
        #site-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 2rem; }
        .site-card { border: 1px solid #eee; padding: 1.5rem; border-radius: 8px; transition: transform 0.2s; }
        .site-card:hover { transform: translateY(-5px); border-color: #000; }

        @media (max-width: 992px) {
            .mobile-header { display: flex; }
            .sidebar { transform: translateX(-100%); }
            .module-content { margin-left: 0; padding: 6rem 1.25rem 2rem; }
            #site-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

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
            <h1 class="display-6 fw-bold">The Capstone Project</h1>
            <p class="text-muted">Combining Box Model, Flexbox, and Grid into a modern landing page.</p>
        </section>

        <div class="row g-5">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 rounded-4 mb-4">
                    <h5 class="mb-3">How it's built:</h5>
                    <div class="mb-4">
                        <span class="badge bg-primary mb-2">Flexbox</span>
                        <p class="small text-muted">Used in the <strong>Navigation</strong> to spread the logo and links apart perfectly.</p>
                    </div>
                    <div class="mb-4">
                        <span class="badge bg-success mb-2">CSS Grid</span>
                        <p class="small text-muted">Used in the <strong>Feature Section</strong> to create a 3-column layout that collapses on mobile.</p>
                    </div>
                    <div class="mb-0">
                        <span class="badge bg-dark mb-2">Box Model</span>
                        <p class="small text-muted">Used everywhere for <strong>padding</strong> inside cards and <strong>margins</strong> between sections.</p>
                    </div>
                </div>

                <button class="btn btn-dark w-100 py-3 rounded-pill fw-bold" onclick="launchConfetti()">
                    Celebrate Completion! 🎉
                </button>
            </div>

            <div class="col-lg-8">
                <div class="project-window">
                    <div class="browser-bar">
                        <div class="dot"></div><div class="dot"></div><div class="dot"></div>
                        <small class="ms-3 text-muted">www.my-first-css-site.com</small>
                    </div>
                    
                    <div id="live-site">
                        <nav id="site-nav">
                            <span class="fw-bold">BRAND.</span>
                            <div class="small text-muted d-flex gap-3">
                                <span>Home</span><span>About</span><span>Contact</span>
                            </div>
                        </nav>

                        <header id="site-hero">
                            <h2 class="fw-bold">Building the Future</h2>
                            <p class="text-muted small mx-auto" style="max-width: 400px;">This hero section uses the Box Model to add padding and center the text content for a clean look.</p>
                            <button class="btn btn-sm btn-dark mt-2">Get Started</button>
                        </header>

                        <section id="site-grid">
                            <div class="site-card">
                                <i data-lucide="zap" class="text-warning mb-2"></i>
                                <h6 class="fw-bold">Fast</h6>
                                <p class="small text-muted mb-0">Optimized performance.</p>
                            </div>
                            <div class="site-card">
                                <i data-lucide="shield" class="text-primary mb-2"></i>
                                <h6 class="fw-bold">Secure</h6>
                                <p class="small text-muted mb-0">SSL Protection.</p>
                            </div>
                            <div class="site-card">
                                <i data-lucide="smartphone" class="text-success mb-2"></i>
                                <h6 class="fw-bold">Responsive</h6>
                                <p class="small text-muted mb-0">Works everywhere.</p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
        
        function launchConfetti() {
            // Simple GSAP "Confetti" burst
            for(let i=0; i<30; i++) {
                const conf = document.createElement('div');
                conf.style.cssText = `position:fixed; width:10px; height:10px; background:hsl(${Math.random()*360}, 70%, 50%); left:50%; top:50%; z-index:9999; border-radius:2px;`;
                document.body.appendChild(conf);
                
                gsap.to(conf, {
                    x: (Math.random()-0.5) * 600,
                    y: (Math.random()-0.5) * 600,
                    rotation: Math.random()*360,
                    opacity: 0,
                    duration: 1.5,
                    onComplete: () => conf.remove()
                });
            }
        }

        gsap.from(".project-window", { opacity: 0, y: 50, duration: 1, ease: "power4.out" });
    </script>
</body>
</html>