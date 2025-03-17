<!-- resources/js/Pages/About.svelte -->
<script>
    import Layout from '../Components/Layout.svelte';
    import { inertia } from '@inertiajs/svelte';

    // Team members data
    const team = [
        {
            name: 'Jane Doe',
            role: 'Founder & CEO',
            image: null,
            bio: 'Jane has over 15 years of experience in web development and is passionate about creating better tools for developers.',
        },
        {
            name: 'John Smith',
            role: 'CTO',
            image: null,
            bio: 'John is an expert in frontend technologies and has been working with JavaScript frameworks since their early days.',
        },
        {
            name: 'Emily Johnson',
            role: 'Lead Developer',
            image: null,
            bio: 'Emily specializes in PHP and has contributed to several open-source projects in the Laravel ecosystem.',
        },
        {
            name: 'Michael Chen',
            role: 'Product Manager',
            image: null,
            bio: 'Michael brings user-focused thinking to our products, with a background in UX design and product management.',
        },
    ];
</script>

<Layout>
    <div class="container">
        <section class="about-header">
            <h1 class="about-title">About Inertia Blog</h1>
            <p class="about-subtitle">We're a team of passionate developers building tools that make web development more enjoyable and productive.</p>
        </section>

        <section class="about-section">
            <div class="section-columns">
                <div class="section-content">
                    <h2 class="section-title">Our Mission</h2>
                    <p>At Inertia Blog, we believe that web development should be both powerful and enjoyable. Our mission is to showcase how modern technologies like Inertia.js, PHP, and Svelte can work together to create seamless user experiences without the complexity of traditional SPAs.</p>
                    <p>We're committed to sharing knowledge, best practices, and real-world examples that help developers build better web applications. Our blog serves as a platform for the community to learn, contribute, and grow together.</p>
                </div>
                <div class="section-image">
                    <div class="image-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="section-columns reverse">
                <div class="section-image">
                    <div class="image-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                    </div>
                </div>
                <div class="section-content">
                    <h2 class="section-title">Our Approach</h2>
                    <p>We take a pragmatic approach to web development. Instead of following trends blindly, we focus on what works best for each specific use case. Sometimes, that means a full SPA with a separate API. Other times, a monolithic approach with Inertia.js is the right choice.</p>
                    <p>Our blog demonstrates how to build modern web applications using PHP on the backend and Svelte on the frontend, connected seamlessly with Inertia.js. This approach allows us to leverage the strengths of both worlds without the complexity of building and maintaining a separate API.</p>
                </div>
            </div>
        </section>

        <section class="team-section">
            <h2 class="section-title center">Meet Our Team</h2>
            <p class="section-subtitle">The people behind Inertia Blog</p>

            <div class="team-grid">
                {#each team as member}
                    <div class="team-card">
                        <div class="member-avatar">
                            {member.name.charAt(0)}
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">{member.name}</h3>
                            <p class="member-role">{member.role}</p>
                            <p class="member-bio">{member.bio}</p>
                        </div>
                    </div>
                {/each}
            </div>
        </section>

        <section class="cta-section">
            <h2 class="cta-title">Join Our Community</h2>
            <p class="cta-text">Connect with us and other developers passionate about modern web development.</p>
            <div class="cta-buttons">
                <a href="/contact" use:inertia class="button button-primary">Get in Touch</a>
                <a href="/posts" use:inertia class="button button-secondary">Read Our Blog</a>
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

    .about-header {
        text-align: center;
        margin-bottom: 4rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .about-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .about-subtitle {
        font-size: 1.25rem;
        color: #6b7280;
    }

    .about-section {
        margin-bottom: 5rem;
    }

    .section-columns {
        display: flex;
        gap: 4rem;
        align-items: center;
    }

    .section-columns.reverse {
        flex-direction: row-reverse;
    }

    .section-content,
    .section-image {
        flex: 1;
    }

    .section-title {
        font-size: 1.875rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .section-title.center {
        text-align: center;
    }

    .section-subtitle {
        text-align: center;
        color: #6b7280;
        margin-bottom: 3rem;
        font-size: 1.125rem;
    }

    .section-content p {
        font-size: 1.125rem;
        line-height: 1.7;
        color: #4b5563;
        margin-bottom: 1.5rem;
    }

    .image-placeholder {
        background-color: #f3f4f6;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 300px;
        color: #9ca3af;
    }

    .team-section {
        margin-bottom: 5rem;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }

    .team-card {
        background-color: #fff;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .member-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #4f46e5;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .member-name {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .member-role {
        color: #4f46e5;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .member-bio {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.6;
    }

    .cta-section {
        background-color: #f9fafb;
        border-radius: 0.5rem;
        padding: 3rem;
        text-align: center;
        margin-bottom: 3rem;
    }

    .cta-title {
        font-size: 1.875rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta-text {
        color: #6b7280;
        font-size: 1.125rem;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
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

    .button-secondary {
        background-color: #fff;
        color: #000;
        border-color: #e5e7eb;
    }

    .button-secondary:hover {
        background-color: #f9fafb;
    }

    @media (max-width: 768px) {
        .section-columns {
            flex-direction: column;
            gap: 2rem;
        }

        .section-columns.reverse {
            flex-direction: column;
        }

        .about-title {
            font-size: 2rem;
        }

        .cta-buttons {
            flex-direction: column;
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>
