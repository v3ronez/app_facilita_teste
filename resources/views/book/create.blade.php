<x-app-layout>
    <div class="flex flex-1 justify-center flex-col items-center h-full w-full gap-4 mt-10">
        <div class="w-[70%] h-full rounded border-2">
            <section class="bg-white rounded border-2">
                <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                    <h2 class="mb-4 text-xl font-bold text-gray-900">Novo Livro</h2>
                    <form action="{{route('admin.book.store')}}" method="POST">
                        @csrf()
                        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                            <div class="sm:col-span-2">
                                <label for="title"
                                       class="block mb-2 text-sm font-medium text-gray-900">Título</label>
                                <input type="text" name="title" id="title"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                       value="" required="required">
                                @error('title')
                                <span class="text-red-600 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="author"
                                       class="block mb-2 text-sm font-medium text-gray-900">Author</label>
                                <input type="text" name="author" id="author"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                       value="" required="required">
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
                                           value="" disabled>
                                </div>
                            @endisset
                            @isset($book)
                                <div class="w-full">
                                    <label for="emprestado para:"
                                           class="block mb-2 text-sm font-medium text-gray-900">Emprestado
                                        para:</label>
                                    <input type="text" name="loanded_for" id="loanded_for"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                           value="" required="required">
                                    @error('loanded_for')
                                    <span class="text-red-600 font-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endisset
                            <div class="w-full">
                                <label for="gender"
                                       class="block mb-2 text-sm font-medium text-gray-900">Gênero</label>
                                <select
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    name="gender">
                                    <option disabled selected>Selecione um gênero</option>
                                    @foreach($genders as $gender)
                                        <option>{{ucfirst($gender->name)}}</option>
                                    @endforeach
                                </select>
                                @error('loanded_for')
                                <span class="text-red-600 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-neutral text-white">
                            Cadastrar
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
