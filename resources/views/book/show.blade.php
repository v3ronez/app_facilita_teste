@php use App\Enums\BookStatusEnum;use Illuminate\Support\Facades\Session; @endphp
<x-app-layout>
    <div class="flex flex-1 justify-center flex-col items-center h-full w-full gap-4 mt-10">
        <div class="w-[70%] h-full rounded border-2">
            <section class="bg-white rounded border-2">
                <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                    <div class="w-full flex flex-1 gap-4 items-center ">
                        <h2 class=" text-xl font-bold text-gray-900">Detalhes do livro</h2>
                        @if($book->status == BookStatusEnum::AVAILABLE)
                            <div
                                class="badge bg-green-400 border-neutral-50 text-gray-800">{{ ucfirst($book->status->value)}}
                            </div>
                        @else
                            <div
                                class="badge bg-red-500 border-red-400 text-white">{{ ucfirst($book->status->value)}}
                            </div>
                        @endif


                    </div>
                    @if(session('success'))
                        <div class="toast toast-md toast-end">
                            <div class="alert alert-success text-white">
                                <span>Message sent successfully.</span>
                            </div>
                        </div>
                    @endif
                    <form action="{{route('book.update', ['id' => $book->id])}}" method="POST">
                        @csrf()
                        @method('PUT')
                        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                            <div class="sm:col-span-2">
                                <label for="title"
                                       class="block mb-2 text-sm font-medium text-gray-900">Título</label>
                                <input type="text" name="title" id="title"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                       value="{{$book->title}}" required="required">
                                @error('title')
                                <span class="text-red-600 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="author"
                                       class="block mb-2 text-sm font-medium text-gray-900">Author</label>
                                <input type="text" name="author" id="author"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                       value="{{$book->author}}" required="required">
                                @error('author')
                                <span class="text-red-600 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            @isset($book)
                                <div class="w-full">
                                    <label for="registration_number"
                                           class="block mb-2 text-sm font-medium text-gray-900">Número de
                                        Cadastro</label>
                                    <input type="text" name="registration_number" id="registration_number"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                           value="{{$book->registration_number}}" disabled>
                                </div>
                            @endisset
                            @if($book->loandedFor())
                                <div class="w-full">
                                    <label for="emprestado para:"
                                           class="block mb-2 text-sm font-medium text-gray-900">Emprestado
                                        para:</label>
                                    <input type="text" name="loanded_for" id="loanded_for"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                           value="{{$book->loandedFor()}}" required="required">
                                    @error('loanded_for')
                                    <span class="text-red-600 font-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            <div class="w-full">
                                <label for="gender"
                                       class="block mb-2 text-sm font-medium text-gray-900">Gênero</label>
                                <select
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    name="gender">
                                    @if(!$book->gender)
                                        <option disabled selected>Selecione um gênero</option>
                                    @endif
                                    @foreach($genders as $gender)
                                        @if($book->gender == ucfirst($gender->name))
                                            <option selected>{{ucfirst($gender->name)}}</option>
                                        @else
                                            <option>{{ucfirst($gender->name)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-neutral text-white">
                            Editar
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
