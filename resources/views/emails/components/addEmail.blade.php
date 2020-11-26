<div class="flex w-1/2 mx-2 bg-white px-6 rounded shadow">
    <form class="w-full" action="/emails" method="POST">
        @csrf
        <div class="flex flex-row">
            <div class="w-1/2 auth_form mr-12">
                <label for="email">Email</label>
                <input type="text" name="email">

                <label for="">ФИО</label>
                <input type="text" name="user_name">
            </div>

            <div class="w-1/2 auth_form">
                <label for="">Организация</label>
                <input type="text" name="organisation">

                <label for="">Источник</label>
                <input type="text" name="source">
            </div>
        </div>

        <button class="button-blue mt-6" type="submit">
            Добавить
        </button>
    </form>
</div>
