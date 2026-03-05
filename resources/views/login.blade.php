<!DOCTYPE html>
<html lang="id">
<head>
  <link rel="icon" href="{{ asset('assets/pln_icon.png') }}" type="image/x-icon" width="16" height="16">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - PLN UP3 Bogor</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    /* Animasi muncul lembut */
    @keyframes fadeSlide {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeSlide 0.6s ease forwards; }

    /* Background pattern */
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: url('https://www.transparenttextures.com/patterns/cubes.png');
      opacity: 0.03;
      z-index: 0;
      pointer-events: none;
    }

    /* Animasi floating halus */
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    .float-animation {
      animation: float 4s ease-in-out infinite;
    }

    /* Prevent scrolling */
    html, body {
      height: 100%;
      overflow: hidden;
      margin: 0;
      padding: 0;
    }

    /* Smooth focus effect */
    input:focus {
      transform: translateY(-2px);
    }
  </style>
</head>

<body class="relative flex items-center justify-center h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900">

  <div class="container flex justify-center items-center fade-in z-10 px-4 sm:px-6 h-full">
    <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 w-full max-w-md relative overflow-hidden">

      <!-- Garis aksen PLN atas -->
      <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600"></div>

      <!-- Logo PLN Section -->
      <div class="flex flex-col items-center mb-6 mt-3">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-2xl shadow-lg mb-4 float-animation border border-blue-100">
          <img src="{{ asset('assets/pln.jpg') }}" alt="Logo PLN" class="w-16 h-16 sm:w-20 sm:h-20 object-contain">
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 tracking-wide text-center">Sistem Login</h1>
        <div class="flex items-center gap-2 mt-2">
          <div class="w-8 h-0.5 bg-blue-600"></div>
          <p class="text-gray-700 font-semibold text-sm sm:text-base">PLN UP3 BOGOR</p>
          <div class="w-8 h-0.5 bg-blue-600"></div>
        </div>
        <p class="text-gray-500 text-xs sm:text-sm mt-2">PT PLN (Persero)</p>
      </div>

      <!-- Error Message -->
      @if (session('error'))
      <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-3 py-2.5 sm:px-4 sm:py-3 rounded-lg mb-5 flex items-start gap-2 sm:gap-3">
        <i class="bi bi-exclamation-circle-fill text-red-500 text-lg flex-shrink-0"></i>
        <span class="text-xs sm:text-sm font-medium">{{ session('error') }}</span>
      </div>
      @endif

      <!-- Form -->
      <form method="POST" action="{{ route('login.process') }}" class="space-y-4">
        @csrf
        
        <!-- Username -->
        <div>
          <label for="username" class="block text-sm font-bold text-gray-700 mb-2">
            <i class="bi bi-person-fill text-blue-600"></i> Username
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="bi bi-person text-gray-400 text-lg"></i>
            </div>
            <input type="text" name="username" id="username"
              class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
              placeholder="Masukkan username Anda" required>
          </div>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
            <i class="bi bi-lock-fill text-blue-600"></i> Password
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="bi bi-key text-gray-400 text-lg"></i>
            </div>
            <input type="password" name="password" id="password"
              class="w-full pl-10 pr-12 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
              placeholder="Masukkan password Anda" required>
            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
              <i id="eye-icon" class="bi bi-eye text-gray-400 hover:text-gray-600 transition text-lg"></i>
            </button>
          </div>
        </div>

        <!-- Submit -->
        <button type="submit"
          class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2 mt-6">
          <i class="bi bi-box-arrow-in-right text-lg"></i>
          Masuk ke Sistem
        </button>
      </form>

      <!-- Footer -->
      <div class="mt-6 pt-5 border-t border-gray-200">
        <div class="flex flex-wrap items-center justify-center gap-2 text-xs text-gray-500 text-center">
          <i class="bi bi-shield-fill-check text-blue-600"></i>
          <span>Sistem Terenkripsi & Aman</span>
        </div>
        <p class="text-center text-xs text-gray-400 mt-2">
          <i class="bi bi-c-circle"></i> 2025 PT PLN (Persero) - UP3 Bogor
        </p>
      </div>

      <!-- Garis bawah -->
      <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-blue-600"></div>
    </div>
  </div>

  <!-- Efek cahaya blur -->
  <div class="fixed w-72 h-72 sm:w-96 sm:h-96 bg-blue-500/20 blur-3xl rounded-full animate-pulse -top-20 -left-20 pointer-events-none"></div>
  <div class="fixed w-72 h-72 sm:w-96 sm:h-96 bg-indigo-500/15 blur-3xl rounded-full animate-pulse top-1/3 -right-20 pointer-events-none"></div>
  <div class="fixed w-72 h-72 sm:w-96 sm:h-96 bg-blue-400/10 blur-3xl rounded-full animate-pulse bottom-0 left-1/4 pointer-events-none"></div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eye-icon');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('bi-eye');
        eyeIcon.classList.add('bi-eye-slash');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('bi-eye-slash');
        eyeIcon.classList.add('bi-eye');
      }
    }
  </script>
</body>
</html>