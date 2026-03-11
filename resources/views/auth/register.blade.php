@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Register Toko Barokah 191</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Nama Lengkap</label>
                <input type="text" name="name"
                    class="w-full px-3 py-2 border rounded @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

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

            <div class="mb-4">
                <label class="block text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-3 py-2 border rounded" required>
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                Register
            </button>
        </form>

        <div class="text-center mt-3 text-gray-500">atau</div>

        <button id="googleRegBtn" type="button"
            class="w-full bg-red-500 text-white py-2 rounded mt-3 hover:bg-red-600 transition flex items-center justify-center gap-2">
            <img src="https://developers.google.com/identity/images/g-logo.png" style="width:20px" />
            Daftar dengan Google
        </button>

        <p class="text-center mt-4 text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js"></script>
<script>
    const firebaseConfig = {
        apiKey: "{{ env('FIREBASE_API_KEY') }}",
        authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
        projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
    };

    firebase.initializeApp(firebaseConfig);
    const provider = new firebase.auth.GoogleAuthProvider();

    document.getElementById("googleRegBtn").addEventListener("click", function () {
        firebase.auth().signInWithPopup(provider)
            .then(result => result.user.getIdToken())
            .then(token =>
                fetch("{{ route('google.authenticate') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ token })
                })
            )
            .then(r => r.json())
            .then(res => {
                if (res.success) window.location.reload();
                else alert("Pendaftaran Google gagal");
            })
            .catch(() => alert("Pendaftaran Google gagal"));
    });
</script>
@endsection
