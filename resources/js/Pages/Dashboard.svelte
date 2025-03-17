<!-- resources/js/Pages/Dashboard.svelte -->
<script>
    import Layout from '../Components/Layout.svelte';
    import PostCard from '../Components/PostCard.svelte';
    import { inertia } from '@inertiajs/svelte';
    import { page } from '@inertiajs/svelte';

    // Props
    let { posts = [] } = $props();

    // Show either posts or analytics view
    let activeTab = 'posts';

    // User stats for display
    const stats = [
        { label: 'Posts Published', value: posts.length, icon: 'file-text' },
        { label: 'Total Views', value: '1,254', icon: 'eye' },
        { label: 'Avg. Read Time', value: '3.2 min', icon: 'clock' },
        { label: 'Comments', value: '27', icon: 'message-circle' },
    ];

    // Change active tab
    function setTab(tab) {
        activeTab = tab;
    }

    // Format date for last login
    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        return new Date(dateString || new Date()).toLocaleDateString('en-US', options);
    };

    // Get user from page props
    let user = $derived($page.props.auth?.user);
</script>

<Layout>
    <div class="container">
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title">Dashboard</h1>
                <p class="dashboard-subtitle">Welcome back, {user.name}</p>
            </div>
            <a href="/posts/create" use:inertia class="button button-primary">Create New Post</a>
        </div>

        <div class="dashboard-stats">
            {#each stats as stat}
                <div class="stat-card">
                    <div class="stat-icon">
                        {#if stat.icon === 'file-text'}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        {:else if stat.icon === 'eye'}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        {:else if stat.icon === 'clock'}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        {:else if stat.icon === 'message-circle'}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                        {/if}
                    </div>
                    <div>
                        <div class="stat-value">{stat.value}</div>
                        <div class="stat-label">{stat.label}</div>
                    </div>
                </div>
            {/each}
        </div>

        <div class="dashboard-tabs">
            <button class="tab-button {activeTab === 'posts' ? 'active' : ''}" on:click={() => setTab('posts')}> My Posts </button>
            <button class="tab-button {activeTab === 'analytics' ? 'active' : ''}" on:click={() => setTab('analytics')}> Analytics </button>
            <button class="tab-button {activeTab === 'profile' ? 'active' : ''}" on:click={() => setTab('profile')}> Profile </button>
        </div>

        <div class="dashboard-content">
            {#if activeTab === 'posts'}
                <div class="dashboard-section">
                    <div class="section-header">
                        <h2 class="section-title">Your Posts</h2>
                        <div class="section-actions">
                            <input type="text" placeholder="Search your posts..." class="search-input" />
                        </div>
                    </div>

                    {#if posts.length > 0}
                        <div class="posts-table">
                            <div class="table-header">
                                <div class="table-col title-col">Title</div>
                                <div class="table-col date-col">Published</div>
                                <div class="table-col views-col">Views</div>
                                <div class="table-col actions-col">Actions</div>
                            </div>

                            {#each posts as post (post.id)}
                                <div class="table-row">
                                    <div class="table-col title-col">
                                        <a href={`/posts/${post.id}`} use:inertia>{post.title}</a>
                                    </div>
                                    <div class="table-col date-col">
                                        {new Date(post.created_at).toLocaleDateString()}
                                    </div>
                                    <div class="table-col views-col">
                                        {Math.floor(Math.random() * 500)}
                                    </div>
                                    <div class="table-col actions-col">
                                        <div class="row-actions">
                                            <a href={`/posts/${post.id}/edit`} use:inertia class="action-link">Edit</a>
                                            <a href={`/posts/${post.id}`} use:inertia class="action-link">View</a>
                                        </div>
                                    </div>
                                </div>
                            {/each}
                        </div>
                    {:else}
                        <div class="empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <h3>No posts yet</h3>
                            <p>Create your first post to get started</p>
                            <a href="/posts/create" use:inertia class="button button-primary">Create New Post</a>
                        </div>
                    {/if}
                </div>
            {:else if activeTab === 'analytics'}
                <div class="dashboard-section">
                    <div class="section-header">
                        <h2 class="section-title">Analytics Overview</h2>
                        <div class="section-actions">
                            <select class="select-control">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>Last 3 months</option>
                                <option>All time</option>
                            </select>
                        </div>
                    </div>

                    <div class="analytics-placeholder">
                        <div class="chart-placeholder">
                            <div class="chart-line"></div>
                            <div class="chart-line"></div>
                            <div class="chart-line"></div>
                        </div>
                        <p class="placeholder-text">Analytics data visualization would go here.</p>
                    </div>
                </div>
            {:else if activeTab === 'profile'}
                <div class="dashboard-section">
                    <div class="section-header">
                        <h2 class="section-title">Profile Information</h2>
                    </div>

                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                {user.name.charAt(0)}
                            </div>
                            <div class="profile-info">
                                <h3 class="profile-name">{user.name}</h3>
                                <p class="profile-email">{user.email}</p>
                                <p class="profile-meta">Last login: {formatDate()}</p>
                            </div>
                        </div>

                        <div class="profile-form">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" class="form-control" value={user.name} />
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" class="form-control" value={user.email} />
                            </div>

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" id="password" class="form-control" placeholder="••••••••" />
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" id="password_confirmation" class="form-control" placeholder="••••••••" />
                            </div>

                            <button type="button" class="button button-primary">Update Profile</button>
                        </div>
                    </div>
                </div>
            {/if}
        </div>
    </div>
</Layout>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .dashboard-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        margin-bottom: 0.25rem;
    }

    .dashboard-subtitle {
        color: #6b7280;
        margin: 0;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background-color: #fff;
        border-radius: 0.5rem;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        background-color: #f3f4f6;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4f46e5;
        margin-right: 1rem;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .dashboard-tabs {
        display: flex;
        border-bottom: 1px solid #eaeaea;
        margin-bottom: 2rem;
    }

    .tab-button {
        padding: 0.75rem 1.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        cursor: pointer;
        transition: all 0.2s;
    }

    .tab-button:hover {
        color: #111827;
    }

    .tab-button.active {
        color: #4f46e5;
        border-bottom-color: #4f46e5;
    }

    .dashboard-section {
        background-color: #fff;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }

    .search-input {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        border: 1px solid #eaeaea;
        border-radius: 0.375rem;
        width: 250px;
    }

    .search-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
    }

    .select-control {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        border: 1px solid #eaeaea;
        border-radius: 0.375rem;
        background-color: white;
    }

    .select-control:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
    }

    .posts-table {
        width: 100%;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .table-header {
        background-color: #f9fafb;
        padding: 0.75rem 1rem;
        font-weight: 500;
        font-size: 0.875rem;
        color: #4b5563;
        display: flex;
    }

    .table-row {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #eaeaea;
        display: flex;
        align-items: center;
    }

    .table-row:last-child {
        border-bottom: none;
    }

    .table-col {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .title-col {
        flex: 3;
    }

    .date-col,
    .views-col {
        flex: 1;
    }

    .actions-col {
        flex: 1;
        text-align: right;
    }

    .row-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .action-link {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .action-link:hover {
        color: #4f46e5;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-state svg {
        color: #9ca3af;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #6b7280;
        margin-bottom: 1.5rem;
    }

    .analytics-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 3rem 0;
    }

    .chart-placeholder {
        width: 100%;
        height: 200px;
        background-color: #f9fafb;
        border-radius: 0.5rem;
        position: relative;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .chart-line {
        position: absolute;
        height: 2px;
        background-color: #e5e7eb;
        width: 100%;
    }

    .chart-line:nth-child(1) {
        top: 25%;
    }

    .chart-line:nth-child(2) {
        top: 50%;
    }

    .chart-line:nth-child(3) {
        top: 75%;
    }

    .placeholder-text {
        color: #6b7280;
        font-style: italic;
    }

    .profile-card {
        padding: 1.5rem;
    }

    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
    }

    .profile-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background-color: #4f46e5;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 600;
        margin-right: 1.5rem;
    }

    .profile-name {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .profile-email {
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .profile-meta {
        font-size: 0.875rem;
        color: #9ca3af;
        margin: 0;
    }

    .profile-form {
        max-width: 600px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        border: 1px solid #eaeaea;
        border-radius: 0.375rem;
        transition:
            border-color 0.2s,
            box-shadow 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
    }

    .button {
        display: inline-block;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        transition: all 0.2s;
        font-size: 0.875rem;
        cursor: pointer;
        text-decoration: none;
        border: 1px solid transparent;
    }

    .button-primary {
        background-color: #000;
        color: #fff;
        border-color: #000;
    }

    .button-primary:hover {
        background-color: #333;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .dashboard-tabs {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 0.5rem;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .search-input,
        .select-control {
            width: 100%;
        }

        .posts-table {
            overflow-x: auto;
        }

        .table-header,
        .table-row {
            width: 700px;
        }

        .profile-header {
            flex-direction: column;
            text-align: center;
        }

        .profile-avatar {
            margin-right: 0;
            margin-bottom: 1rem;
        }
    }
</style>
