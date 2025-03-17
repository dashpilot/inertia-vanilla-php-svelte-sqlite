<script>
    import Layout from '../../Components/Layout.svelte';
    import { inertia } from '@inertiajs/svelte';

    // Props
    let { post, errors = [], values = null } = $props();

    // Use the passed values or fall back to the post data
    let title = values?.title ?? post.title;
    let content = values?.content ?? post.content;

    // For delete confirm dialog
    let showDeleteModal = $state(false);

    function toggleDeleteModal() {
        showDeleteModal = !showDeleteModal;
    }

    function deletePost() {
        document.getElementById('deleteForm').submit();
    }
</script>

<Layout>
    <div class="form-container">
        <div class="form-card">
            <div class="form-header">
                <h1>Edit Post</h1>
                <p>Update your post content</p>
            </div>

            {#if errors.length > 0}
                <div class="error-box">
                    <div class="error-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="error-content">
                        <h3>Please fix the following errors:</h3>
                        <ul>
                            {#each errors as error}
                                <li>{error}</li>
                            {/each}
                        </ul>
                    </div>
                </div>
            {/if}

            <form method="post" action={`/posts/${post.id}`}>
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" name="title" id="title" value={title} required />
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="12" required>{content}</textarea>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <button type="button" class="button button-danger" on:click={toggleDeleteModal}> Delete Post </button>
                    </div>

                    <div class="form-actions">
                        <a href={`/posts/${post.id}`} use:inertia class="button button-secondary"> Cancel </a>
                        <button type="submit" class="button button-primary"> Update Post </button>
                    </div>
                </div>
            </form>

            <!-- Hidden delete form -->
            <form id="deleteForm" method="post" action={`/posts/${post.id}/delete`} style="display: none;"></form>
        </div>
    </div>

    <!-- Delete confirmation modal -->
    {#if showDeleteModal}
        <div class="modal-overlay">
            <div class="modal">
                <h2>Delete Post</h2>
                <p>Are you sure you want to delete this post? This action cannot be undone.</p>
                <div class="modal-actions">
                    <button class="button button-secondary" on:click={toggleDeleteModal}>Cancel</button>
                    <button class="button button-danger" on:click={deletePost}>Delete</button>
                </div>
            </div>
        </div>
    {/if}
</Layout>
