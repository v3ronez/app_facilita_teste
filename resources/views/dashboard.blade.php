<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl flex h-full gap-5 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1">
                <div class="p-6 text-gray-900 flex flex-col gap-5">
                    <h1 class="text-3xl">Ver perfil</h1>
                    <span> Visualize todos os usuários cadastrados no sistema.</span>
                    <button class="btn btn-neutral font-black text-lg text-white"><a class="w-full"
                                                                                     href="{{ route('admin.user.index')}}">Ver
                            perfis</a></button>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1">
                <div class="p-6 text-gray-900 flex flex-col gap-5">
                    <h1 class="text-3xl">Ver livros</h1>
                    <span>Visualize todos os livros cadastrados no sistema e seus detalhes.</span>
                    <button class="btn btn-neutral font-black text-lg text-white">
                        <a class="w-full" href="{{ route('admin.book.index')}}">Ver Livros</a>
                    </button>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1">
                <div class="p-6 text-gray-900 flex flex-col gap-5">
                    <h1 class="text-3xl">Ver empréstimos</h1>
                    <span>Visualize todos os empréstimos.</span>
                    <button class="btn btn-neutral font-black text-lg text-white">
                        <a class="w-full" href="{{route('admin.loan.index')}}">Ver empréstimos</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
