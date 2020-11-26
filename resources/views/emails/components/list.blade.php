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


                    @forelse($emails as $email)

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
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Активна
                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="/emails/{{$email->id}}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
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
