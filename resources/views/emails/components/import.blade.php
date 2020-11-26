<div class="flex w-1/2 mx-2 bg-white px-6 rounded shadow items-center">
    <div class="flex w-full flex-col justify-center">
        <form class="mx-2 auth_form" action="/check" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="file">Валидация email</label>
            <input type="file" name="filecheck">
            @error('filecheck')
            <div class="text-sm text-red-500">{{$message}}</div>
            @enderror
            <button class="button-blue" type="submit">Проверить</button>
        </form>

        <form class="mx-2 auth_form " action="/import" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="file">Загрузка xlsx</label>
            <input type="file" name="file">
            @error('file')
            <div class="text-sm text-red-500">{{$message}}</div>
            @enderror
            <button class="button-blue" type="submit">Загрузить</button>
        </form>
    </div>
</div>
