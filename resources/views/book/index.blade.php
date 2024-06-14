<x-app-layout>
    <div class="flex flex-1 justify-center flex-col items-center h-full w-full gap-4 mt-10">
        <h1 class="font-bold text-4xl">Usúarios</h1>
        <div class="w-[90%] h-full phone-6 bg-white ">
            <div class="overflow-x-auto p-5">
                <table class="table">
                    <thead>
                    <tr class="font-bold text-lg text-gray-700">
                        <th></th>
                        <th>Nome</th>
                        <th>Documento</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($books as $book)
                        <tr class="font-bold text-lg text-gray-500">
                            <th>#</th>
                            <td>{{$book->title}}</td>
                            <td>{{formatCpf($book->author)}}</td>
                            <td>{{$book->gender}}</td>
                            <td>
                                <button class="btn btn-neutral"><a href="{{ route('book.show', ['id' => $book->id]) }}">Ver
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
