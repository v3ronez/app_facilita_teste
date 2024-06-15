@php use App\Enums\BookStatusEnum; @endphp
<x-app-layout>
    <div class="flex flex-1 justify-center flex-col items-center h-full w-full gap-4 mt-10">
        <h1 class="font-bold text-4xl">Livros</h1>
        <div class="w-[90%] h-full phone-6 bg-white">
            <div class="max-w-fit m-5 flex">
                <button class="btn btn-neutral"><a href="{{route('book.create')}}">Novo</a></button>
            </div>
            <div class="overflow-x-auto p-5">
                <table class="table">
                    <thead>
                    <tr class="font-bold text-lg text-gray-700">
                        <th></th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($books as $book)
                        <tr class="font-bold text-lg text-gray-500">
                            <th>#</th>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author}}</td>
                            <td class="{!!$book->status == BookStatusEnum::AVAILABLE ? 'text-green-600': 'text-red-600'!!}">{{$book->status}}</td>
                            <td>
                                <button class="btn btn-neutral"><a href="">Ver
                                        Perfil</a></button>
                            </td>
                        </tr>
                    @empty
                        <tr>Não há livros cadastrados.</tr>
                    @endforelse
                </table>
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
