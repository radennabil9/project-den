<!DOCTYPE html>
<html lang="id">
<head>
  <link rel="icon" href="{{ asset('assets/pln_icon.png') }}" type="image/x-icon" width="16" height="16">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - PLN UP3 Bogor</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Animasi muncul lembut */
    @keyframes fadeSlide {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeSlide 0.9s ease forwards; }

    /* Background pattern */
    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: url('https://www.transparenttextures.com/patterns/cubes.png');
      opacity: 0.05;
      z-index: 0;
    }

    /* Animasi floating */
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }
    .float-animation {
      animation: float 6s ease-in-out infinite;
    }
  </style>
</head>

<body class="relative flex items-center justify-center min-h-screen bg-gradient-to-br from-emerald-900 via-emerald-700 to-emerald-500 overflow-hidden">

  <div class="container flex justify-center items-center fade-in z-10 px-4 sm:px-6">
    <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 w-full max-w-md relative overflow-hidden">

      <!-- Garis aksen PLN atas -->
      <div class="absolute top-0 left-0 w-full h-3 bg-gradient-to-r from-yellow-400 via-blue-500 to-emerald-600"></div>

      <!-- Logo PLN Section -->
      <div class="flex flex-col items-center mb-8 mt-4">
        <div class="bg-gradient-to-br from-emerald-50 to-blue-50 p-4 rounded-2xl shadow-lg mb-4 float-animation">
          <img src="{{ asset('assets/pln.jpg') }}" alt="Logo PLN" class="w-16 h-16 sm:w-20 sm:h-20 object-contain">
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 tracking-wide text-center">Sistem Login</h1>
        <div class="flex items-center gap-2 mt-2">
          <div class="w-8 h-0.5 bg-emerald-600"></div>
          <p class="text-gray-600 font-semibold text-sm sm:text-base">PLN UP3 BOGOR</p>
          <div class="w-8 h-0.5 bg-emerald-600"></div>
        </div>
        <p class="text-gray-500 text-xs sm:text-sm mt-2">PT PLN (Persero)</p>
      </div>

      <!-- Error Message -->
      @if (session('error'))
      <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-3 py-2 sm:px-4 sm:py-3 rounded-lg mb-6 flex items-start gap-2 sm:gap-3">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
        <span class="text-xs sm:text-sm font-medium">{{ session('error') }}</span>
      </div>
      @endif

      <!-- Form -->
      <form method="POST" action="{{ route('login.process') }}" class="space-y-5">
        @csrf
        
        <!-- Username -->
        <div>
          <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Username</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <input type="text" name="username" id="username"
              class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
              placeholder="Masukkan username Anda" required>
          </div>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <input type="password" name="password" id="password"
              class="w-full pl-10 pr-12 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
              placeholder="Masukkan password Anda" required>
            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
              <svg id="eye-icon" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Submit -->
        <button type="submit"
          class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
          </svg>
          Masuk ke Sistem
        </button>
      </form>

      <!-- Footer -->
      <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="flex flex-wrap items-center justify-center gap-2 text-xs text-gray-500 text-center">
          <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
          </svg>
          <span>Sistem Terenkripsi & Aman</span>
        </div>
        <p class="text-center text-xs text-gray-400 mt-2">© 2025 PT PLN (Persero) - UP3 Bogor</p>
      </div>

      <!-- Garis bawah -->
      <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-600 via-blue-500 to-yellow-400"></div>
    </div>
  </div>

  <!-- Efek cahaya -->
  <div class="absolute w-72 h-72 sm:w-96 sm:h-96 bg-emerald-500/20 blur-3xl rounded-full animate-pulse -top-20 -left-20"></div>
  <div class="absolute w-72 h-72 sm:w-96 sm:h-96 bg-blue-500/15 blur-3xl rounded-full animate-pulse top-1/3 -right-20"></div>
  <div class="absolute w-72 h-72 sm:w-96 sm:h-96 bg-yellow-400/10 blur-3xl rounded-full animate-pulse bottom-0 left-1/4"></div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eye-icon');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7" />`;
      } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7" />`;
      }
    }
  </script>
</body>
</html>
