<x-app-layout>
    @if(session('deleted'))
        <div class="toast toast-top toast-end mt-12">
            <div class="alert alert-error text-white">
                <span>Message sent successfully.</span>
            </div>
        </div>
    @endif
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
                    @forelse($users as $user)
                        <tr class="font-bold text-lg text-gray-500">
                            <th>#</th>
                            <td>{{$user->name}}</td>
                            <td>{{formatCpf($user->document)}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <button class="btn btn-neutral"><a
                                        href="{{ route('user.show', ['id' => $user->id]) }}">Ver
                                        Perfil</a></button>
                            </td>
                        </tr>
                    @empty
                        <tr>Não usuário foi cadastrado ainda.</tr>
                    @endforelse
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
