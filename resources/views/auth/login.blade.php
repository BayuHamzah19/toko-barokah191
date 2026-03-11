@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Login Toko Barokah 191</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email"
                    class="w-full px-3 py-2 border rounded @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" required>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password"
                    class="w-full px-3 py-2 border rounded @error('password') border-red-500 @enderror"
                    required>
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                Login
            </button>
        </form>

        <div class="text-center mt-3 text-gray-500">atau</div>

        <button id="googleLoginbtn" type="button"
            class="w-full bg-red-500 text-white py-2 rounded mt-3 hover:bg-red-600 transition flex items-center justify-center gap-2">
            <img src="https://developers.google.com/identity/images/g-logo.png" style="width:20px" />
            Login dengan Google
        </button>

        <p class="text-center mt-4 text-gray-600">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
        </p>
    </div>
</div>

<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
    import { 
        getAuth, 
        GoogleAuthProvider, 
        signInWithPopup 
    } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";

    // Firebase Config Load From .env Laravel
    const firebaseConfig = {
        apiKey: "{{ env('FIREBASE_API_KEY') }}",
        authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
        projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
    };

    // Init Firebase
    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    const provider = new GoogleAuthProvider();

    // Handle Google Login Button
    const googleButton = document.getElementById("googleLoginbtn");

    if (googleButton) {
        googleButton.addEventListener("click", async (event) => {
            event.preventDefault(); // pastikan
            try {
                const result = await signInWithPopup(auth, provider);
                const idToken = await result.user.getIdToken();

                const response = await fetch("{{ route('google.authenticate') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ token: idToken })
                });

                const data = await response.json();

                if (data.success) {
                    // redirect Laravel route
                    window.location.href = "/user/dashboard"; 
                } else {
                    alert("Login gagal: token tidak valid.");
                }
            } catch (error) {
                console.error("Google Auth Error:", error);
                alert("Login Google gagal. Cek console untuk detail.");
            }
        });
    }
</script>


@endsection
