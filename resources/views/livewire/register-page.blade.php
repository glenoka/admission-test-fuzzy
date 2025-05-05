<div class="min-h-screen bg-gray-50">
    @include('layouts.homepage.includes.navbar-four')
    
    <div class="py-36 md:py-64 w-full table relative bg-cover bg-center">
        <div class="w-full max-w-md space-y-8 bg-white rounded-xl shadow-lg p-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Daftar Akun</h2>
                <p class="mt-2 text-gray-600">
                    Sudah punya akun? 
                    <a href="" class="text-orange-600 hover:text-orange-500">
                        Masuk disini
                    </a>
                </p>
            </div>

            <form wire:submit.prevent="create" @csrf>
                <div class="space-y-4">
                    {{ $this->form }}
                </div>

                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-300">
                    Daftar Sekarang
                </button>
            </form>
        </div>
    </div>
</div>


