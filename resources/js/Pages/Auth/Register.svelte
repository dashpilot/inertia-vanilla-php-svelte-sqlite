<script>
    import Layout from '../../Components/Layout.svelte';
    import { inertia } from '@inertiajs/svelte';

    // Props with default values
    let { errors = {}, old = { name: '', email: '' } } = $props();
</script>

<Layout>
    <div class="auth-container">
        <div class="form-card">
            <div class="form-header text-center">
                <h1>Create an Account</h1>
                <p>Join our community and start sharing your stories</p>
            </div>

            <form method="post" action="/register">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" value={old.name} placeholder="John Doe" class={errors.name ? 'input-error' : ''} />
                    {#if errors.name}
                        <p class="error-message">{errors.name}</p>
                    {/if}
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value={old.email} placeholder="your@email.com" class={errors.email ? 'input-error' : ''} />
                    {#if errors.email}
                        <p class="error-message">{errors.email}</p>
                    {/if}
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class={errors.password ? 'input-error' : ''} />
                    {#if errors.password}
                        <p class="error-message">{errors.password}</p>
                    {:else}
                        <p class="help-text">Must be at least 8 characters</p>
                    {/if}
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" />
                </div>

                <div class="form-group">
                    <button type="submit" class="button button-primary button-full"> Create Account </button>
                </div>

                <div class="text-center">
                    <p class="redirect-text">
                        Already have an account?
                        <a href="/login" use:inertia>Sign in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</Layout>
