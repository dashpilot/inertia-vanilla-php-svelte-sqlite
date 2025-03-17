<!-- resources/js/Components/Layout.svelte -->
<script>
    import { page } from '@inertiajs/svelte';
    import { inertia } from '@inertiajs/svelte';

    // Check if user is authenticated
    let isAuthenticated = $derived($page.props.auth && $page.props.auth.user);
</script>

<div class="site-container">
    <header class="site-header">
        <div class="header-content">
            <div class="logo">
                <a href="/" use:inertia>
                    <span class="logo-text">Inertia<span class="logo-accent">Blog</span></span>
                </a>
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="/" use:inertia class:active={$page.url === '/'}>Home</a></li>
                    <li><a href="/posts" use:inertia class:active={$page.url.startsWith('/posts')}>Articles</a></li>
                    <li><a href="/about" use:inertia class:active={$page.url === '/about'}>About</a></li>
                    <li><a href="/contact" use:inertia class:active={$page.url === '/contact'}>Contact</a></li>

                    <!-- Authentication Links -->
                    {#if isAuthenticated}
                        <li><a href="/dashboard" use:inertia class:active={$page.url === '/dashboard'}>Dashboard</a></li>
                        <li>
                            <form method="post" action="/logout" class="logout-form">
                                <button type="submit" class="logout-button">Logout</button>
                            </form>
                        </li>
                    {:else}
                        <li><a href="/login" use:inertia class:active={$page.url === '/login'}>Login</a></li>
                        <li><a href="/register" use:inertia class:active={$page.url === '/register'}>Register</a></li>
                    {/if}
                </ul>
            </nav>

            <!-- Mobile Menu Button (could be expanded with actual functionality) -->
            <button class="mobile-menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </header>

    <main class="site-content">
        <slot />
    </main>

    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-logo">
                <span class="logo-text">Inertia<span class="logo-accent">Blog</span></span>
                <p class="footer-tagline">A blog showcasing the power of Inertia.js with Vanilla PHP, Svelte and SQLite.</p>
            </div>

            <div class="footer-links-container">
                <div class="footer-links">
                    <h3>About</h3>
                    <ul>
                        <li><a href="/about" use:inertia>Company</a></li>
                        <li><a href="/team" use:inertia>Team</a></li>
                        <li><a href="/blog" use:inertia>Blog</a></li>
                        <li><a href="/careers" use:inertia>Careers</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="/documentation" use:inertia>Documentation</a></li>
                        <li><a href="/api" use:inertia>API References</a></li>
                        <li><a href="/community" use:inertia>Community</a></li>
                        <li><a href="/tutorials" use:inertia>Tutorials</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="/privacy" use:inertia>Privacy Policy</a></li>
                        <li><a href="/terms" use:inertia>Terms of Service</a></li>
                        <li><a href="/cookies" use:inertia>Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Inertia Blog. All rights reserved.</p>
            <p>Made with care for developers everywhere</p>
        </div>
    </footer>
</div>

<style>
    /* Reset and base styles */
    :global(*, *::before, *::after) {
        box-sizing: border-box;
    }

    :global(body) {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        color: #333;
        background-color: #f9fafb;
    }

    :global(h1, h2, h3, h4, h5, h6) {
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-weight: 600;
        line-height: 1.2;
    }

    :global(a) {
        color: #333;
        text-decoration: none;
    }

    :global(a:hover) {
        color: #4f46e5;
    }

    :global(p) {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    /* Layout styles */
    .site-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .site-header {
        background-color: #fff;
        border-bottom: 1px solid #eaeaea;
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo-text {
        font-weight: bold;
        font-size: 1.25rem;
    }

    .logo-accent {
        font-weight: normal;
        opacity: 0.7;
    }

    .main-nav ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 2rem;
    }

    .main-nav a {
        font-size: 0.9rem;
        font-weight: 500;
        position: relative;
    }

    .main-nav a.active {
        color: #4f46e5;
    }

    /* Logout button styling to look like a link */
    .logout-form {
        margin: 0;
        padding: 0;
    }

    .logout-button {
        background: none;
        border: none;
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        cursor: pointer;
        padding: 0;
        font-family: inherit;
    }

    .logout-button:hover {
        color: #4f46e5;
    }

    /* Mobile menu button */
    .mobile-menu-button {
        display: none;
        background: none;
        border: none;
        color: #333;
        cursor: pointer;
        padding: 0.5rem;
    }

    .site-content {
        flex: 1;
        padding: 2rem 0;
    }

    .site-footer {
        background-color: #fff;
        border-top: 1px solid #eaeaea;
        padding: 3rem 0 1.5rem;
        margin-top: 2rem;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .footer-logo {
        flex: 1;
        min-width: 250px;
    }

    .footer-tagline {
        margin-top: 0.75rem;
        color: #6b7280;
        font-size: 0.9rem;
        max-width: 300px;
    }

    .footer-links-container {
        display: flex;
        flex-wrap: wrap;
        gap: 3rem;
    }

    .footer-links h3 {
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .footer-links ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 0.5rem;
    }

    .footer-links a {
        font-size: 0.9rem;
        color: #6b7280;
    }

    .footer-links a:hover {
        color: #4f46e5;
    }

    .footer-bottom {
        max-width: 1200px;
        margin: 3rem auto 0;
        padding: 1.5rem 1.5rem 0;
        border-top: 1px solid #eaeaea;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        font-size: 0.8rem;
        color: #9ca3af;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .header-content {
            flex-direction: row;
            align-items: center;
        }

        .main-nav {
            display: none;
        }

        .mobile-menu-button {
            display: block;
        }

        .footer-content,
        .footer-bottom {
            flex-direction: column;
            gap: 1.5rem;
        }

        .footer-links-container {
            flex-direction: column;
            gap: 1.5rem;
        }
    }
</style>
