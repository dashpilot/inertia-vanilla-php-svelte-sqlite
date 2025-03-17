<!-- resources/js/Pages/Home.svelte -->
<script>
    import Layout from '../Components/Layout.svelte';
    import PostCard from '../Components/PostCard.svelte';
    import { inertia } from '@inertiajs/svelte';
    import { page } from '@inertiajs/svelte';

    // Props
    let { latestPosts = [] } = $props();

    // Check if user is authenticated
    let isAuthenticated = $derived($page.props.auth && $page.props.auth.user);
</script>

<Layout>
    <div class="container">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-tag">Inertia.js + Vanilla PHP + Svelte</div>
                <h1 class="hero-title">
                    A modern approach to building
                    <span class="highlight">monolithic</span> web applications
                </h1>
                <p class="hero-description">Create beautiful, responsive, and interactive web applications without the complexity of a traditional SPA setup.</p>
                <div class="hero-buttons">
                    <a href="/posts/create" use:inertia class="button button-primary">Get Started →</a>
                    <a href="/documentation" use:inertia class="button button-secondary">View Documentation</a>
                </div>
            </div>
        </section>

        <!-- Featured Articles Section -->
        <section class="featured-section">
            <div class="section-header">
                <h2 class="section-title">Featured Articles</h2>
                <a href="/posts" use:inertia class="section-link">View all articles</a>
            </div>

            <div class="featured-posts">
                {#if latestPosts.length > 0}
                    {#each latestPosts as post (post.id)}
                        <PostCard {post} />
                    {/each}
                {:else}
                    <div class="empty-state">
                        <p>No posts yet.</p>
                        {#if isAuthenticated}
                            <a href="/posts/create" use:inertia class="button button-primary">Create your first post</a>
                        {:else}
                            <p>
                                <a href="/login" use:inertia class="text-link">Log in</a> to create a post.
                            </p>
                        {/if}
                    </div>
                {/if}
            </div>
        </section>

        <!-- Code Example Section -->
        <section class="code-example-section">
            <div class="section-header">
                <div class="badge">Simple Implementation</div>
                <h2 class="section-title">Elegant code that's easy to understand</h2>
            </div>

            <div class="container-sm">
                <div class="code-window">
                    <div class="code-header">
                        <span class="code-dot"></span>
                        <span class="code-dot"></span>
                        <span class="code-dot"></span>
                        <span class="code-filename">App.svelte</span>
                    </div>
                    <pre class="code-content">
  <code>Hello world</code>
          </pre>
                </div>
            </div>

            <p class="code-description">Inertia.js doesn't replace your backend or frontend framework; it simply leverages both to create a seamless developer and user experience.</p>

            <div class="center-button">
                <a href="/learn-more" use:inertia class="button button-primary">Learn More</a>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-tag">Ready to start?</div>
            <h2 class="cta-title">Join thousands of developers building modern apps with Inertia.js</h2>
            <p class="cta-description">Experience the perfect balance between traditional server-rendered applications and modern single-page applications.</p>
            <div class="cta-buttons">
                <a href="/get-started" use:inertia class="button button-primary">Get Started →</a>
                <a href="/documentation" use:inertia class="button button-secondary">View Documentation</a>
            </div>
        </section>
    </div>
</Layout>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .container-sm {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* Hero Section */
    .hero-section {
        padding: 4rem 0 5rem;
        text-align: center;
    }

    .hero-tag {
        display: inline-block;
        font-size: 0.875rem;
        color: #4b5563;
        margin-bottom: 1.5rem;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .highlight {
        background-color: #000;
        color: #fff;
        padding: 0 0.5rem;
    }

    .hero-description {
        font-size: 1.125rem;
        color: #6b7280;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    /* Featured Posts Section */
    .featured-section {
        padding: 3rem 0;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    .section-link {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .section-link:hover {
        color: #4f46e5;
    }

    .featured-posts {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem;
        background-color: #f9fafb;
        border-radius: 0.5rem;
    }

    /* Code Example Section */
    .code-example-section {
        padding: 4rem 0;
    }

    .badge {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 500;
        color: #6b7280;
        background-color: #f3f4f6;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        margin-bottom: 0.75rem;
    }

    .code-window {
        background-color: #1e1e1e;
        border-radius: 0.5rem;
        overflow: hidden;
        margin: 2rem 0;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .code-header {
        background-color: #2d2d2d;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
    }

    .code-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #ff5f56;
        margin-right: 6px;
    }

    .code-dot:nth-child(2) {
        background-color: #ffbd2e;
    }

    .code-dot:nth-child(3) {
        background-color: #27c93f;
    }

    .code-filename {
        margin-left: 1rem;
        font-size: 0.875rem;
        color: #9ca3af;
    }

    .code-content {
        padding: 1.5rem;
        margin: 0;
        color: #e5e7eb;
        font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        font-size: 0.875rem;
        line-height: 1.6;
        overflow-x: auto;
    }

    .code-description {
        text-align: center;
        max-width: 600px;
        margin: 2rem auto;
        color: #6b7280;
    }

    .center-button {
        text-align: center;
        margin-top: 2rem;
    }

    /* CTA Section */
    .cta-section {
        padding: 4rem 0;
        text-align: center;
        background-color: #f9fafb;
        border-radius: 0.5rem;
        margin: 2rem 0;
    }

    .cta-tag {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .cta-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-description {
        font-size: 1.125rem;
        color: #6b7280;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    /* Button Styles */
    .button {
        display: inline-block;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        transition: all 0.2s;
        font-size: 0.875rem;
    }

    .button-primary {
        background-color: #000;
        color: #fff;
        border: 1px solid #000;
    }

    .button-primary:hover {
        background-color: #333;
        color: #fff;
    }

    .button-secondary {
        background-color: #fff;
        color: #000;
        border: 1px solid #e5e7eb;
    }

    .button-secondary:hover {
        background-color: #f9fafb;
        color: #000;
    }

    .text-link {
        color: #4f46e5;
        text-decoration: none;
    }

    .text-link:hover {
        text-decoration: underline;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-buttons,
        .cta-buttons {
            flex-direction: column;
            gap: 0.75rem;
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .featured-posts {
            grid-template-columns: 1fr;
        }
    }
</style>
