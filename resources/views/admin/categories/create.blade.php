<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kategori - Perpus Omar</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-[#fafafa] dark:bg-[#0f0f0f] text-[#1a1a1a] dark:text-[#f3f3f3] flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-lg">
        <header class="mb-10 text-center">
            <h2 class="text-3xl font-bold mb-2">Tambah Kategori</h2>
            <p class="text-gray-500">Buat kategori baru untuk mengelompokkan koleksi buku.</p>
        </header>

        <div class="bg-white dark:bg-[#161616] rounded-3xl p-8 shadow-2xl ring-1 ring-gray-200 dark:ring-gray-800">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold mb-2 ml-1">Nama Kategori</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-5 py-4 bg-gray-50 dark:bg-gray-800 rounded-2xl border-none ring-1 ring-gray-200 dark:ring-gray-700 focus:ring-2 focus:ring-indigo-500 transition-all outline-none"
                               placeholder="Contoh: Teknologi, Sejarah, Fiksi..." value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('admin.categories.index') }}" class="flex-1 py-4 text-center text-gray-400 hover:text-gray-600 font-bold transition-all">Batal</a>
                        <button type="submit" class="flex-2 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl shadow-xl shadow-indigo-500/25 transition-all active:scale-95 font-bold">Simpan Kategori</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
