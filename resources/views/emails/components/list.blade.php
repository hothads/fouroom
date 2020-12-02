<h1 class="text-2xl font-bold my-6 uppercase">Получатели рассылки</h1>

<div class="flex flex-col mb-12">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-400 text-left text-xs font-medium text-gray-600 uppercase tracking-widest">
                            Email/Источник
                        </th>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-400 text-left text-xs font-medium text-gray-600 uppercase tracking-widest">
                            ФИО/Организация
                        </th>

                        <th scope="col"
                            class="px-6 py-3 bg-gray-400 text-left text-xs font-medium text-gray-600 uppercase tracking-widest">
                            Подписка
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-400">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">


                    @forelse($list->emails as $email)

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{$email->email}}</div>
                                <div class="text-sm text-gray-500">{{$email->source}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{$email->user_name}}</div>
                                <div class="text-sm text-gray-500">{{$email->organisation}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">

                            {!!$email->active ? '<div class="text-green-500">есть</div>' : 'нет'!!}

                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end">
                                    <a href="/emails/{{$email->id}}"
                                       class=" mr-6 text-indigo-600 hover:text-indigo-900">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>

                                    <form action="/lists/{{$email->emaillist->id}}/emails/{{$email->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">

                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>

                                        </button>

                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        Нет записей
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
