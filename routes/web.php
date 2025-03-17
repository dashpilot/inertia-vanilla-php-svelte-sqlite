<?php
// routes/web.php
require_once __DIR__ . '/../bootstrap.php';

use App\Inertia;
use App\Models\Post;
use App\Models\User;
use App\Middleware\Auth;
use Bramus\Router\Router;

$router = new Router();

// Home route
$router->get('/', function() {
    // Get the latest 3 posts for the homepage
    $latestPosts = Post::all();
    $latestPosts = array_slice($latestPosts, 0, 3);
    
    echo Inertia::render('Home', [
        'latestPosts' => $latestPosts
    ]);
});

// About page
$router->get('/about', function() {
    echo Inertia::render('About');
});

// About page
$router->get('/contact', function() {
    echo Inertia::render('Contact');
});

// Blog posts listing
$router->get('/posts', function() {
    $posts = Post::all();
    
    echo Inertia::render('Posts/Index', [
        'posts' => $posts
    ]);
});

// Show a single post
$router->get('/posts/(\d+)', function($id) {
    $post = Post::find($id);
    
    if (!$post) {
        header('Location: /posts');
        exit;
    }
    
    echo Inertia::render('Posts/Show', [
        'post' => $post
    ]);
});

// Display post creation form - PROTECTED
$router->get('/posts/create', function() {
    // Require authentication
    Auth::handle();
    
    echo Inertia::render('Posts/Create');
});

// Handle post creation - PROTECTED
$router->post('/posts', function() {
    // Require authentication
    Auth::handle();
    
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    
    // Simple validation
    if (empty($title) || empty($content)) {
        echo Inertia::render('Posts/Create', [
            'errors' => ['Please fill in all required fields'],
            'values' => [
                'title' => $title,
                'content' => $content
            ]
        ]);
        return;
    }
    
    $user = User::current();
    
    $postId = Post::create([
        'title' => $title,
        'content' => $content,
        'user_id' => $user['id']
    ]);
    
    header('Location: /posts/' . $postId);
    exit;
});

// Display post edit form - PROTECTED
$router->get('/posts/(\d+)/edit', function($id) {
    // Require authentication
    Auth::handle();
    
    $post = Post::find($id);
    
    if (!$post) {
        header('Location: /posts');
        exit;
    }
    
    // Check if the user owns this post
    $user = User::current();
    if ($post['user_id'] != $user['id']) {
        // User doesn't own this post, redirect
        header('Location: /posts');
        exit;
    }
    
    echo Inertia::render('Posts/Edit', [
        'post' => $post
    ]);
});

// Handle post update - PROTECTED
$router->post('/posts/(\d+)', function($id) {
    // Require authentication
    Auth::handle();
    
    $post = Post::find($id);
    
    if (!$post) {
        header('Location: /posts');
        exit;
    }
    
    // Check if the user owns this post
    $user = User::current();
    if ($post['user_id'] != $user['id']) {
        // User doesn't own this post, redirect
        header('Location: /posts');
        exit;
    }
    
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    
    // Simple validation
    if (empty($title) || empty($content)) {
        echo Inertia::render('Posts/Edit', [
            'errors' => ['Please fill in all required fields'],
            'post' => $post,
            'values' => [
                'title' => $title,
                'content' => $content
            ]
        ]);
        return;
    }
    
    Post::update($id, [
        'title' => $title,
        'content' => $content
    ]);
    
    header('Location: /posts/' . $id);
    exit;
});

// Handle post deletion - PROTECTED
$router->post('/posts/(\d+)/delete', function($id) {
    // Require authentication
    Auth::handle();
    
    $post = Post::find($id);
    
    if (!$post) {
        header('Location: /posts');
        exit;
    }
    
    // Check if the user owns this post
    $user = User::current();
    if ($post['user_id'] != $user['id']) {
        // User doesn't own this post, redirect
        header('Location: /posts');
        exit;
    }
    
    Post::delete($id);
    
    header('Location: /posts');
    exit;
});

// Authentication routes
$router->get('/login', function() {
    // Redirect to dashboard if already logged in
    Auth::guest();
    
    echo Inertia::render('Auth/Login', [
        'errors' => $_SESSION['errors'] ?? [],
        'old' => $_SESSION['old'] ?? []
    ]);
    
    // Clear session data
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
});

$router->post('/login', function() {
    // Redirect to dashboard if already logged in
    Auth::guest();
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Validate input
    $errors = [];
    
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Valid email is required';
    }
    
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }
    
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = [
            'email' => $email,
            'remember' => $remember
        ];
        
        header('Location: /login');
        exit;
    }
    
    // Attempt to log in
    if (!User::attempt($email, $password)) {
        $_SESSION['errors'] = [
            'email' => 'These credentials do not match our records'
        ];
        $_SESSION['old'] = [
            'email' => $email,
            'remember' => $remember
        ];
        
        header('Location: /login');
        exit;
    }
    
    // Redirect to dashboard
    header('Location: /dashboard');
    exit;
});

$router->get('/register', function() {
    // Redirect to dashboard if already logged in
    Auth::guest();
    
    echo Inertia::render('Auth/Register', [
        'errors' => $_SESSION['errors'] ?? [],
        'old' => $_SESSION['old'] ?? []
    ]);
    
    // Clear session data
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
});

$router->post('/register', function() {
    // Redirect to dashboard if already logged in
    Auth::guest();
    
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordConfirmation = $_POST['password_confirmation'] ?? '';
    
    // Validate input
    $errors = [];
    
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }
    
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Valid email is required';
    } elseif (User::findByEmail($email)) {
        $errors['email'] = 'This email is already taken';
    }
    
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    } elseif ($password !== $passwordConfirmation) {
        $errors['password'] = 'Password confirmation does not match';
    }
    
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = [
            'name' => $name,
            'email' => $email
        ];
        
        header('Location: /register');
        exit;
    }
    
    // Create user
    $userId = User::create([
        'name' => $name,
        'email' => $email,
        'password' => $password
    ]);
    
    // Log the user in
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    
    // Redirect to dashboard
    header('Location: /dashboard');
    exit;
});

$router->post('/logout', function() {
    User::logout();
    
    header('Location: /');
    exit;
});

// Dashboard route (protected)
$router->get('/dashboard', function() {
    // Require authentication
    Auth::handle();
    
    // Get recent posts by the current user
    $user = User::current();
    $posts = Post::where('user_id', $user['id']);
    
    echo Inertia::render('Dashboard', [
        'posts' => $posts
    ]);
});

// Run the router
$router->run();