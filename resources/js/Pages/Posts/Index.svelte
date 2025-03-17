<!-- resources/js/Pages/Posts/Index.svelte -->
<script>
    import Layout from '../../Components/Layout.svelte';
    import PostCard from '../../Components/PostCard.svelte';
    import { inertia } from '@inertiajs/svelte';
    import { page } from '@inertiajs/svelte';

    // Props
    let { posts = [] } = $props();

    // Check if user is authenticated
    let isAuthenticated = $derived($page.props.auth && $page.props.auth.user);
</script>

<Layout>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Articles</h1>

            <!-- Only show New Post button to authenticated users -->
            {#if isAuthenticated}
                <a href="/posts/create" use:inertia class="button button-primary"> New Post </a>
            {/if}
        </div>

        <!--
        <div class="posts-filters">
            <div class="search-box">
                <input type="text" placeholder="Search articles..." class="search-input" />
                <button class="search-button">Search</button>
            </div>

            <div class="filter-tags">
                <button class="filter-tag active">All</button>
                <button class="filter-tag">Tutorials</button>
                <button class="filter-tag">Performance</button>
                <button class="filter-tag">Architecture</button>
            </div>
        </div>
        -->

        {#if posts.length > 0}
            <div class="posts-grid">
                {#each posts as post (post.id)}
                    <PostCard {post} />
                {/each}
            </div>
        {:else}
            <div class="empty-state">
                <h3>No posts found</h3>
                <p>We couldn't find any posts matching your criteria.</p>

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
</Layout>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eaeaea;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }

    .posts-filters {
        margin-bottom: 2rem;
    }

    .search-box {
        display: flex;
        margin-bottom: 1rem;
    }

    .search-input {
        flex-grow: 1;
        padding: 0.5rem 1rem;
        border: 1px solid #e5e7eb;
        border-right: none;
        border-radius: 0.375rem 0 0 0.375rem;
        font-size: 0.875rem;
    }

    .search-input:focus {
        outline: none;
        border-color: #4f46e5;
    }

    .search-button {
        padding: 0.5rem 1rem;
        background-color: #000;
        color: #fff;
        border: 1px solid #000;
        border-radius: 0 0.375rem 0.375rem 0;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .search-button:hover {
        background-color: #333;
    }

    .filter-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .filter-tag {
        padding: 0.25rem 0.75rem;
        background-color: #f3f4f6;
        border: none;
        border-radius: 9999px;
        font-size: 0.75rem;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s;
    }

    .filter-tag:hover {
        background-color: #e5e7eb;
    }

    .filter-tag.active {
        background-color: #000;
        color: #fff;
    }

    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background-color: #f9fafb;
        border-radius: 0.5rem;
    }

    .empty-state h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #6b7280;
        margin-bottom: 1.5rem;
    }

    .button {
        display: inline-block;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        transition: all 0.2s;
        font-size: 0.875rem;
        text-decoration: none;
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

    .text-link {
        color: #4f46e5;
        text-decoration: none;
    }

    .text-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .posts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
