<x-app-layout>
    <div class="flex flex-1 justify-center flex-col items-center h-full w-full gap-4 mt-10">
        <h1 class="font-bold text-4xl">Empréstimos</h1>
        <div class="w-[90%] h-full phone-6 bg-white ">
            <div class="overflow-x-auto p-5">
                <table class="table">
                    <thead>
                    <tr class="font-bold text-lg text-gray-700">
                        <th></th>
                        <th>Livro</th>
                        <th>Emprestado para</th>
                        <th>CPF</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($loans as $loan)
                        <tr class="font-bold text-lg text-gray-500">
                            <th>#</th>
                            <td>{{$loan->title}}</td>
                            <td>{{$loan->name}}</td>
                            <td>{{formatCpf($loan->document)}}</td>
                            <td>{{ucfirst($loan->loan_status)}}</td>
                            <td>
                                <button class="btn btn-neutral"><a
                                        href="{{ route('user.show', ['id' => $loan->user_id]) }}">Ver detalhes</a>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>Não usuário foi cadastrado ainda.</tr>
                    @endforelse
                </table>
                {{ $loans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
