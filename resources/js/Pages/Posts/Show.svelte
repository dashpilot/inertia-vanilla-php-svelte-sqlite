<!-- resources/js/Pages/Posts/Show.svelte -->
<script>
    import Layout from '../../Components/Layout.svelte';
    import { inertia } from '@inertiajs/svelte';
    import { page } from '@inertiajs/svelte';

    // Props
    let { post } = $props();

    // Delete confirmation
    let showDeleteConfirm = false;

    function confirmDelete() {
        showDeleteConfirm = true;
    }

    function cancelDelete() {
        showDeleteConfirm = false;
    }

    function deletePost() {
        // Submit the delete form
        document.getElementById('deleteForm').submit();
    }

    // Check if the current user owns this post
    let isOwner = $derived($page.props.auth && $page.props.auth.user && post.user_id && $page.props.auth.user.id === parseInt(post.user_id));

    // Format date
    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    };

    // Calculate reading time
    let readingTime = $derived(Math.ceil(post.content.length / 1000));
</script>

<Layout>
    <div class="container">
        <article class="post">
            <div class="post-meta-top">
                <div class="post-category">Inertia + Svelte + PHP</div>
                <div class="post-date">{formatDate(post.created_at)}</div>
            </div>

            <h1 class="post-title">{post.title}</h1>

            <div class="post-meta">
                {#if post.author_name}
                    <div class="post-author">
                        <div class="author-avatar">
                            {post.author_name.charAt(0)}
                        </div>
                        <div class="author-info">
                            <div class="author-name">{post.author_name}</div>
                            <div class="post-reading-time">{readingTime} min read</div>
                        </div>
                    </div>
                {/if}

                <!-- Only show edit/delete buttons to post owner -->
                {#if isOwner}
                    <div class="post-actions">
                        <a href={`/posts/${post.id}/edit`} use:inertia class="button button-secondary"> Edit </a>
                        <button on:click={confirmDelete} class="button button-danger"> Delete </button>
                    </div>
                {/if}
            </div>

            <div class="post-content">
                {post.content}
            </div>

            <div class="post-footer">
                <a href="/posts" use:inertia class="back-link"> ← Back to articles </a>

                <div class="post-share">
                    <span>Share this article:</span>
                    <div class="share-buttons">
                        <button class="share-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </button>
                        <button class="share-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                        </button>
                        <button class="share-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </article>

        <div class="related-posts">
            <h2 class="related-title">You Might Also Like</h2>
            <div class="related-grid">
                <!-- This would be populated with actual related posts -->
                <div class="related-post">
                    <div class="related-category">Tutorial</div>
                    <h3 class="related-post-title">
                        <a href="#" use:inertia>Getting Started with Inertia.js and Svelte</a>
                    </h3>
                </div>

                <div class="related-post">
                    <div class="related-category">Performance</div>
                    <h3 class="related-post-title">
                        <a href="#" use:inertia>Optimizing Your Inertia App for Speed</a>
                    </h3>
                </div>

                <div class="related-post">
                    <div class="related-category">Architecture</div>
                    <h3 class="related-post-title">
                        <a href="#" use:inertia>Building Robust APIs with PHP and Inertia</a>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete confirmation modal -->
    {#if showDeleteConfirm}
        <div class="modal-overlay">
            <div class="modal">
                <h2>Delete Post</h2>
                <p>Are you sure you want to delete this post? This action cannot be undone.</p>
                <div class="modal-actions">
                    <button on:click={cancelDelete} class="button button-secondary"> Cancel </button>
                    <button on:click={deletePost} class="button button-danger"> Delete </button>
                </div>
            </div>
        </div>
    {/if}

    <form id="deleteForm" method="post" action={`/posts/${post.id}/delete`} style="display: none;"></form>
</Layout>

<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .post {
        margin-bottom: 4rem;
    }

    .post-meta-top {
        display: flex;
        justify-content: space-between;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1.5rem;
    }

    .post-category {
        font-weight: 500;
    }

    .post-title {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 2rem;
    }

    .post-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .post-author {
        display: flex;
        align-items: center;
    }

    .author-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #4f46e5;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-right: 1rem;
    }

    .author-name {
        font-weight: 500;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .post-reading-time {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .post-actions {
        display: flex;
        gap: 0.75rem;
    }

    .post-content {
        font-size: 1.125rem;
        line-height: 1.7;
        color: #374151;
        margin-bottom: 3rem;
    }

    .post-content p {
        margin-bottom: 1.5rem;
    }

    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 2rem;
        border-top: 1px solid #eaeaea;
    }

    .back-link {
        font-weight: 500;
        color: #4b5563;
        text-decoration: none;
    }

    .back-link:hover {
        color: #4f46e5;
    }

    .post-share {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .share-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .share-button {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid #e5e7eb;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s;
    }

    .share-button:hover {
        background-color: #f9fafb;
        color: #4f46e5;
    }

    .related-posts {
        margin-top: 4rem;
        padding-top: 3rem;
        border-top: 1px solid #eaeaea;
    }

    .related-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 2rem;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
    }

    .related-post {
        background-color: #f9fafb;
        padding: 1.5rem;
        border-radius: 0.5rem;
        transition:
            transform 0.2s,
            box-shadow 0.2s;
    }

    .related-post:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .related-category {
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }

    .related-post-title {
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.4;
        margin: 0;
    }

    .related-post-title a {
        color: #111827;
        text-decoration: none;
    }

    .related-post-title a:hover {
        color: #4f46e5;
    }

    /* Modal styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 100;
    }

    .modal {
        background-color: white;
        border-radius: 0.5rem;
        padding: 2rem;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .modal h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-top: 0;
        margin-bottom: 1rem;
    }

    .modal p {
        color: #4b5563;
        margin-bottom: 1.5rem;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    /* Button styles */
    .button {
        display: inline-block;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        border: 1px solid transparent;
    }

    .button-secondary {
        background-color: white;
        color: #111827;
        border-color: #e5e7eb;
    }

    .button-secondary:hover {
        background-color: #f9fafb;
    }

    .button-danger {
        background-color: white;
        color: #ef4444;
        border-color: #ef4444;
    }

    .button-danger:hover {
        background-color: #fee2e2;
    }

    @media (max-width: 768px) {
        .post-title {
            font-size: 2rem;
        }

        .post-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .post-footer {
            flex-direction: column;
            gap: 1.5rem;
            align-items: flex-start;
        }

        .related-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
