<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PT Mitra Sarana Technindo</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/logoKapalJaki.png') }}">
    <script>tailwind.config={theme:{extend:{colors:{navy:{900:'#102a43',950:'#0a1929'}},fontFamily:{sans:['Inter','system-ui','-apple-system','sans-serif'],heading:['Montserrat','system-ui','-apple-system','sans-serif']}}}}</script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="flex items-center justify-center min-h-screen p-4 bg-navy-950 font-sans">
    <div class="w-full max-w-md mx-auto">
        <!-- Header Section (Brand & Identity) -->
        <div class="flex flex-col items-center mb-8 text-center">
            <div
                class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-2xl bg-white/10 backdrop-blur-sm hover:scale-105">
                <i data-lucide="anchor" class="w-8 h-8 text-white"></i>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-white font-heading">Admin Panel</h1>
            <p class="mt-1.5 text-sm tracking-wide text-slate-400">PT Mitra Sarana Technindo</p>
        </div>

        <!-- Card Form Section -->
        <div class="p-8 bg-white border shadow-2xl border-slate-100 rounded-2xl">
            <h2 class="mb-6 text-xl font-bold tracking-tight text-slate-900 font-heading">Masuk ke Dashboard</h2>

            <!-- Laravel Error Alert -->
            @if($errors->any())
                <div
                    class="flex items-center px-4 py-3 mb-6 text-sm text-red-700 border border-red-100 rounded-xl bg-red-50 animate-fade-in">
                    <span class="font-medium">{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Form Layout -->
            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Input Group -->
                <div>
                    <label for="email" class="block mb-1.5 text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}"
                        class="w-full px-4 py-3 text-sm transition-all duration-200 border outline-none border-slate-200 rounded-xl bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-slate-900 focus:border-slate-900 placeholder-slate-400"
                        placeholder="admin@mitrast.com">
                </div>

                <!-- Password Input Group -->
                <div>
                    <label for="password" class="block mb-1.5 text-sm font-semibold text-slate-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 text-sm transition-all duration-200 border outline-none border-slate-200 rounded-xl bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-slate-900 focus:border-slate-900 placeholder-slate-400"
                        placeholder="Masukkan password">
                </div>

                <!-- Remember Me & Utility -->
                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded text-slate-900 border-slate-300 focus:ring-slate-900 focus:ring-offset-1">
                        <label for="remember"
                            class="ml-2 text-sm font-medium cursor-pointer select-none text-slate-600">Ingat saya</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 text-sm font-semibold text-white transition-all duration-200 rounded-xl bg-slate-900 hover:bg-slate-800 focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 active:scale-[0.99]">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>z
    <script>lucide.createIcons();</script>
</body>
</html>
