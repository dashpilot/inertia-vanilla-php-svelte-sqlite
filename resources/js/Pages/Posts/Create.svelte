<script>
    import Layout from '../../Components/Layout.svelte';
    import { inertia } from '@inertiajs/svelte';

    // Props
    let { errors = [], values = { title: '', content: '' } } = $props();
</script>

<Layout>
    <div class="form-container">
        <div class="form-card">
            <div class="form-header">
                <h1>Create New Post</h1>
                <p>Share your thoughts with the community</p>
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

            <form method="post" action="/posts">
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" name="title" id="title" value={values.title} placeholder="Enter a descriptive title" required />
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="12" placeholder="Write your post content here..." required>{values.content}</textarea>
                    <p class="help-text">Use clear paragraphs and headers to organize your content.</p>
                </div>

                <div class="form-actions">
                    <a href="/posts" use:inertia class="button button-secondary"> Cancel </a>
                    <button type="submit" class="button button-primary"> Publish Post </button>
                </div>
            </form>
        </div>
    </div>
</Layout>
