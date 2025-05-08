<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com?version=4.0.6"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fff5f2',
                            100: '#ffebe6',
                            200: '#ffd6cc',
                            300: '#ffb8a3',
                            400: '#ff8a66',
                            500: '#f54900', // Your primary color
                            600: '#e04100',
                            700: '#b23200',
                            800: '#8e2800',
                            900: '#6d1f00',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        :root {
            --tw-primary-500: #f54900;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
        }
        .form-card {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 
                        0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen w-full">
    <!-- Full-width background with centered content -->
    <div class="flex min-h-screen w-full items-center justify-center p-4 sm:p-6">
        <!-- Centered form card -->
        <div class="w-full max-w-md">
            <div class="form-card bg-white rounded-xl overflow-hidden">
                <!-- Header with your orange color -->
                <div class="bg-primary-500 py-6 px-6 text-center">
                    <h2 class="text-2xl font-bold text-white tracking-tight">Create Account</h2>
                    <p class="mt-1 text-primary-100 text-sm">Get started with your free account</p>
                </div>
                
                <!-- Form container -->
                <div class="p-6 sm:p-8">
                    {{ $this->form }}
                </div>
                
                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 text-center">
                    <p class="text-sm text-gray-600">
                        Already registered? 
                        <a href="{{ route('filament.admin.auth.login') }}" 
                           class="font-medium text-primary-600 hover:text-primary-500 transition-colors">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>