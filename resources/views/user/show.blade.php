@php use App\Enums\BookStatusEnum;use Illuminate\Support\Facades\Session; @endphp
<x-app-layout>
    <div class="flex flex-1 justify-center flex-col items-center h-full w-full gap-4 mt-10">
        <div class="w-[70%] h-full rounded border-2">
            <section class="bg-white rounded border-2">
                @if(session('success'))
                    <div class="toast toast-top toast-end mt-12">
                        <div class="alert alert-success text-white">
                            <span>Usuário editado com sucesso</span>
                        </div>
                    </div>
                @endif
                <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                    <div class="flex flex-1 justify-between">
                        <h2 class="mb-4 text-xl font-bold text-gray-900">Perfil</h2>
                        @if(auth()->user()->isAdmin)
                            <div class="flex  justify-end items-end gap-4">
                                <button class="btn text-gray-200" onclick="my_modal_5.showModal()">Novo empréstimo
                                </button>
                                {{--                            modal--}}
                                <dialog id="my_modal_5" class="modal">
                                    <div class="bg-white modal-box w-11/12 max-w-5xl">
                                        <h3 class="font-bold text-lg">Cadastrar</h3>
                                        <p class="py-4">cadastre um novo emprestimo.</p>
                                        <div class="modal-action">
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
                                                            <td class="{{$book->status == BookStatusEnum::AVAILABLE ? 'text-green-600': 'text-red-600'}}">
                                                                {{ ucfirst($book->status->value)}}
                                                            </td>
                                                            <td>
                                                                <div class="flex items-center gap-2 flex-1">
                                                                    <button class="btn btn-neutral"><a
                                                                            href="{{route('book.show', ['id' => $book->id])}}">Detalhes</a>
                                                                    </button>
                                                                    @if($book->status == BookStatusEnum::AVAILABLE)
                                                                        <form method="POST"
                                                                              action="{{route('loan.store', ['id'=> $user->id])}}">
                                                                            <input name="book_id" value="{{$book->id}}"
                                                                                   hidden>
                                                                            @csrf()
                                                                            <button type="submit"
                                                                                    class="btn btn-success text-white">
                                                                                Cadastrar
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <button
                                                                            class="btn-disabled text-red-700">
                                                                            Indisponível
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>Não há livros cadastrados no sistema.</tr>
                                                    @endforelse
                                                </table>
                                                <div class="flex gap-2">
                                                    <button class="btn">Close</button>
                                                    <button class="btn">Cadastrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </dialog>
                                {{--                            end model--}}
                                <form action="{{route('user.delete', ['id'=> $user->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf()
                                    <button type="submit"
                                            class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                        @csrf()
                        @method('PUT')
                        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                            <div class="sm:col-span-2">
                                <label for="name"
                                       class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" name="name" id="name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                       value="{{$user->name}}" required="required">
                                @error('name')
                                <span class="text-red-600 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="email"
                                       class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="email" name="email" id="email"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                       value="{{$user->email}}" required="required">
                                @error('email')
                                <span class="text-red-600 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="document"
                                       class="block mb-2 text-sm font-medium text-gray-900">CPF</label>
                                <input type="text" name="document" id="document"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                       value="{{formatCpf($user->document)}}" required="required">
                                @error('document')
                                <span class="text-red-600 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="registration_number"
                                       class="block mb-2 text-sm font-medium text-gray-900">Número de
                                    Cadastro</label>
                                <input type="text" name="registration_number" id="registration_number"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                       value="{{$user->registration_number}}" disabled>
                            </div>
                            @if(auth()->user()->isAdmin)
                                <div class="w-full">
                                    <label for="isAdmin"
                                           class="block mb-2 text-sm font-medium text-gray-900">Admin</label>
                                    <input type="checkbox" name="isAdmin" value=""
                                           {{$user->isAdmin ? 'checked': ''}}
                                           class="checkbox"/>
                                </div>
                            @endif
                        </div>
                        <div class=" flex items-center space-x-4">
                            <button type="submit" class="btn btn-neutral text-white">Atualizar perfil</button>
                        </div>
                    </form>
                </div>
                <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                    <h2 class="text-gray-700">Livros Emprestados</h2>
                    <div class="overflow-x-auto">
                        <table class="table text-gray-800">
                            <thead>
                            <tr class="text-gray-800">
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Status</th>
                                <th></th>
                                @if(auth()->user()->isAdmin)
                                    <th>Ações</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user->books as $book)
                                <tr>
                                    <th>{{$book->title}}</th>
                                    <td>{{$book->author}}</td>
                                    <td colspan="2">{{$book->pivot->loan_status ?? 'Em dia'}}</td>
                                    @if(auth()->user()->isAdmin)
                                        <td>
                                            <form>

                                                <button type="submit" class="btn btn-neutral text-white">Editar</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td>Não há livros com esse usuário</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Open the modal using ID.showModal() method -->
</x-app-layout>
