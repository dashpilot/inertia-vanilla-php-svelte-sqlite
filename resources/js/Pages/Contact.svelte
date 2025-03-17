<!-- resources/js/Pages/Contact.svelte -->
<script>
    import Layout from '../Components/Layout.svelte';
    import { inertia } from '@inertiajs/svelte';
</script>

<Layout>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Contact Us</h1>
        </div>

        <div class="contact-content">
            <div class="contact-info-card">
                <h2 class="section-heading">Get in Touch</h2>

                <div class="contact-method">
                    <div class="method-label">Email:</div>
                    <div class="method-value">contact@example.com</div>
                </div>

                <div class="contact-method">
                    <div class="method-label">Phone:</div>
                    <div class="method-value">+1 (555) 123-4567</div>
                </div>

                <div class="contact-method">
                    <div class="method-label">Address:</div>
                    <div class="method-value">
                        123 Web Dev Street<br />
                        San Francisco, CA 94107
                    </div>
                </div>
            </div>

            <div class="social-links">
                <h2 class="section-heading">Follow Us</h2>
                <p>Connect with us on social media for the latest updates and articles.</p>
                <div class="social-buttons">
                    <a href="https://twitter.com" target="_blank" class="social-button">Twitter</a>
                    <a href="https://github.com" target="_blank" class="social-button">GitHub</a>
                    <a href="https://linkedin.com" target="_blank" class="social-button">LinkedIn</a>
                </div>
            </div>

            <div class="support-section">
                <h2 class="section-heading">Support</h2>
                <p>Need technical support or have questions about our blog?</p>
                <p>Email us at <a href="mailto:support@example.com">support@example.com</a> and we'll get back to you as soon as possible.</p>
            </div>
        </div>
    </div>
</Layout>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .page-header {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eaeaea;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }

    .contact-content {
        display: grid;
        gap: 2rem;
    }

    .contact-info-card {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .section-heading {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 0;
        margin-bottom: 1.5rem;
    }

    .contact-method {
        margin-bottom: 1rem;
        display: flex;
    }

    .method-label {
        font-weight: 600;
        width: 80px;
    }

    .method-value {
        color: #4b5563;
    }

    .social-links {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .social-links p {
        color: #4b5563;
        margin-bottom: 1.5rem;
    }

    .social-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .social-button {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #f3f4f6;
        color: #4b5563;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        transition: background-color 0.2s;
        text-decoration: none;
    }

    .social-button:hover {
        background-color: #e5e7eb;
        color: #000;
    }

    .support-section {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .support-section p {
        color: #4b5563;
    }

    .support-section a {
        color: #4f46e5;
        text-decoration: none;
    }

    .support-section a:hover {
        text-decoration: underline;
    }

    @media (min-width: 768px) {
        .contact-content {
            grid-template-columns: 1fr 1fr;
        }

        .support-section {
            grid-column: span 2;
        }
    }
</style>
