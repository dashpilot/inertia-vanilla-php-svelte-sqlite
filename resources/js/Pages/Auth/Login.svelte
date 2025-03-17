<script>
    import Layout from '../../Components/Layout.svelte';
    import { inertia } from '@inertiajs/svelte';

    // Props with default values
    let { errors = {}, old = { email: '', remember: false } } = $props();
</script>

<Layout>
    <div class="auth-container">
        <div class="form-card">
            <div class="form-header text-center">
                <h1>Welcome Back</h1>
                <p>Sign in to your account to continue</p>
            </div>

            <form method="post" action="/login">
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
                    {/if}
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember" checked={old.remember} />
                        <span>Remember me</span>
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit" class="button button-primary button-full"> Sign in </button>
                </div>

                <div class="text-center">
                    <p class="redirect-text">
                        Don't have an account?
                        <a href="/register" use:inertia>Sign up</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</Layout>
