<!-- resources/js/Components/PostCard.svelte -->
<script>
    import { inertia } from '@inertiajs/svelte';

    // Props
    let { post, showFullContent = false } = $props();
</script>

<div class="post-card">
    <div class="post-card-content">
        <div class="post-category">Inertia + Svelte + PHP</div>
        <h3 class="post-title">
            <a href={`/posts/${post.id}`} use:inertia>{post.title}</a>
        </h3>
        <div class="post-excerpt">
            {#if showFullContent}
                {post.content}
            {:else}
                {post.content.length > 150 ? post.content.substring(0, 150) + '...' : post.content}
            {/if}
        </div>
        <div class="post-meta">
            {#if post.author_name}
                <span class="post-author">{post.author_name}</span>
            {/if}
            <span class="post-date">{new Date(post.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</span>
            <span class="post-reading-time">{Math.ceil(post.content.length / 1000)} min read</span>
        </div>
    </div>
</div>

<style>
    .post-card {
        background-color: #fff;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition:
            transform 0.2s,
            box-shadow 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .post-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .post-card-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .post-category {
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }

    .post-title {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .post-title a {
        color: #111827;
        text-decoration: none;
    }

    .post-title a:hover {
        color: #4f46e5;
    }

    .post-excerpt {
        font-size: 0.875rem;
        color: #4b5563;
        margin-bottom: 1.5rem;
        line-height: 1.5;
        flex-grow: 1;
    }

    .post-meta {
        font-size: 0.75rem;
        color: #6b7280;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .post-author {
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .post-card {
            height: auto;
        }
    }
</style>
