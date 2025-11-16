<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} – API UI</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --surface: #ffffff;
            --background: #f8fafc;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            background: var(--background);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .section-wrapper {
            max-width: 1400px;
            margin: auto;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            color: white;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(-30%, 30%);
        }

        /* Card */
        .m3-card {
            background: var(--surface);
            border-radius: 16px;
            padding: 1.75rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .m3-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-5px);
        }

        /* Titles */
        .m3-title {
            font-size: 1.25rem;
            color: var(--text-primary);
            font-weight: 700;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .m3-title i {
            color: var(--primary);
            font-size: 1.1rem;
        }

        /* Input */
        .m3-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: #fafafa;
            color: var(--text-primary);
            font-size: 0.95rem;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }

        .m3-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background: white;
        }

        /* Buttons */
        .m3-button {
            width: 100%;
            padding: 0.875rem;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.95rem;
            background: var(--primary);
            margin-top: auto;
        }

        .m3-button:hover {
            background: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }

        /* Response section */
        .response-box {
            background: var(--surface);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 1.5rem;
            border: 1px solid var(--border);
            min-height: 200px;
            overflow-x: auto;
            white-space: pre-wrap;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .response-container {
            margin-top: 3rem;
            margin-bottom: 2rem;
        }

        /* Grid layout improvements */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 1.75rem;
        }

        /* Status indicators */
        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .status-get { background-color: #10b981; }
        .status-post { background-color: #f59e0b; }
        .status-put { background-color: #3b82f6; }
        .status-delete { background-color: #ef4444; }

        /* Method badges */
        .method-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: auto;
        }

        .method-get { background: #d1fae5; color: #065f46; }
        .method-post { background: #fef3c7; color: #92400e; }
        .method-put { background: #dbeafe; color: #1e40af; }
        .method-delete { background: #fee2e2; color: #991b1b; }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Success/Error states */
        .success { color: #10b981; }
        .error { color: #ef4444; }

        /* Footer */
        .footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-top: 3rem;
        }
    </style>
</head>

<body class="p-6">

    <div class="section-wrapper">

        <!-- Header Section -->
        <div class="header">
            <div class="relative z-10">
                <h1 class="text-4xl font-bold text-center mb-4">
                    <i class="fas fa-cloud text-white mr-3"></i>API Testing Dashboard
                </h1>
                <p class="text-center text-white/90 max-w-2xl mx-auto">
                    Welcome to the API Testing Dashboard. Use the forms below to interact with the API and view the responses at the bottom.
                </p>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="cards-grid">

            <!-- REGISTER USER -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-user-plus"></i>
                    <span>Register User</span>
                    <span class="method-badge method-post">POST</span>
                </div>
                <form class="api-form" action="{{ url('api/users') }}" method="POST">
                    @csrf
                    <input name="first_name" placeholder="First Name" class="m3-input">
                    <input name="last_name" placeholder="Last Name" class="m3-input">
                    <input name="email" type="email" placeholder="Email" class="m3-input">
                    <input name="contact_number" placeholder="Contact Number" class="m3-input">
                    <input name="address" placeholder="Address" class="m3-input">
                    <input name="birthdate" type="date" class="m3-input">
                    <select name="gender" class="m3-input">
                        <option value="">Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    <input name="password" type="password" placeholder="Password" class="m3-input">
                    <button class="m3-button">Register</button>
                </form>
            </div>

            <!-- LOGIN -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                    <span class="method-badge method-post">POST</span>
                </div>
                <form class="api-form" action="{{ url('api/login') }}" method="POST">
                    @csrf
                    <input name="email" type="email" placeholder="Email" class="m3-input">
                    <input name="password" type="password" placeholder="Password" class="m3-input">
                    <button class="m3-button">Login</button>
                </form>
            </div>

            <!-- GET FIRST USER -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-user"></i>
                    <span>Get First User</span>
                    <span class="method-badge method-get">GET</span>
                </div>
                <form class="api-form" action="{{ url('api/user') }}" method="GET">
                    <button class="m3-button">Fetch User</button>
                </form>
            </div>

            <!-- UPDATE USER -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-edit"></i>
                    <span>Update User</span>
                    <span class="method-badge method-put">PUT</span>
                </div>
                <form class="api-form" action="{{ url('api/user') }}" method="POST">
                    @csrf @method('PUT')
                    <input name="first_name" placeholder="First Name" class="m3-input">
                    <input name="last_name" placeholder="Last Name" class="m3-input">
                    <input name="email" placeholder="Email" class="m3-input">
                    <input name="address" placeholder="Address" class="m3-input">
                    <input name="birthdate" type="date" class="m3-input">
                    <select name="gender" class="m3-input">
                        <option value="">Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    <button class="m3-button">Update</button>
                </form>
            </div>

            <!-- DELETE USER -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-trash-alt"></i>
                    <span>Delete First User</span>
                    <span class="method-badge method-delete">DELETE</span>
                </div>
                <form class="api-form" action="{{ url('api/user') }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="m3-button">Delete</button>
                </form>
            </div>

            <!-- UPLOAD PROFILE -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-upload"></i>
                    <span>Upload Profile Picture</span>
                    <span class="method-badge method-post">POST</span>
                </div>
                <form class="api-form" action="{{ url('api/user/upload-profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="m3-input">
                    <button class="m3-button">Upload</button>
                </form>
            </div>

            <!-- CHANGE PASSWORD -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-key"></i>
                    <span>Change Password</span>
                    <span class="method-badge method-put">PUT</span>
                </div>
                <form class="api-form" action="{{ url('api/user/change-password') }}" method="POST">
                    @csrf @method('PUT')
                    <input name="old_password" type="password" placeholder="Old Password" class="m3-input">
                    <input name="new_password" type="password" placeholder="New Password" class="m3-input">
                    <input name="new_password_confirmation" type="password" placeholder="Confirm" class="m3-input">
                    <button class="m3-button">Change</button>
                </form>
            </div>

            <!-- LOGOUT -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                    <span class="method-badge method-post">POST</span>
                </div>
                <form class="api-form" action="{{ url('api/logout') }}" method="POST">
                    @csrf
                    <button class="m3-button">Logout</button>
                </form>
            </div>

            <!-- LIST USERS -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-users"></i>
                    <span>List Users</span>
                    <span class="method-badge method-get">GET</span>
                </div>
                <form class="api-form" action="{{ url('api/users') }}" method="GET">
                    <button class="m3-button">Get All</button>
                </form>
            </div>

            <!-- VIEW USER -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-eye"></i>
                    <span>View User by ID</span>
                    <span class="method-badge method-get">GET</span>
                </div>
                <form class="api-form" action="{{ url('api/users') }}" method="GET"
                    onsubmit="this.action = '/api/users/' + this.user_id.value;">
                    <input name="user_id" placeholder="User ID" class="m3-input">
                    <button class="m3-button">View</button>
                </form>
            </div>

            <!-- DELETE USER BY ID -->
            <div class="m3-card">
                <div class="m3-title">
                    <i class="fas fa-trash"></i>
                    <span>Delete User by ID</span>
                    <span class="method-badge method-delete">DELETE</span>
                </div>
                <form class="api-form" method="POST" onsubmit="this.action = '/api/users/' + this.user_id.value;">
                    @csrf @method('DELETE')
                    <input name="user_id" placeholder="User ID" class="m3-input">
                    <button class="m3-button">Delete</button>
                </form>
            </div>

        </div>

        <!-- RESPONSE SECTION -->
        <div class="response-container">
            <h2 class="text-2xl font-bold mb-4 text-gray-700 flex items-center">
                <i class="fas fa-code mr-2 text-indigo-500"></i>API Response
            </h2>
            <div id="responseBox" class="response-box">
                Waiting for response...
            </div>
        </div>

    </div>

    <script>
        document.querySelectorAll("form.api-form").forEach(form => {
            form.addEventListener("submit", async function(event) {
                event.preventDefault();

                const responseBox = document.getElementById("responseBox");

                let url = form.action;
                let method = form.getAttribute("method") || "POST";
                method = method.toUpperCase();

                let formData;

                // File upload uses FormData
                if (form.enctype === "multipart/form-data") {
                    formData = new FormData(form);
                } else {
                    formData = new FormData(form);
                }

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: method !== "GET" ? {
                            "Accept": "application/json"
                        } : {},
                        body: method === "GET" ? null : formData
                    });

                    const result = await response.json();

                    responseBox.textContent = JSON.stringify(result, null, 4);
                    alert("Response received! Check the API Response section.");

                } catch (error) {
                    responseBox.textContent = "Error: " + error;
                }
            });
        });
    </script>

</body>
</html>