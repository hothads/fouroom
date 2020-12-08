<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InviteKey;
use App\Emails;
use App\User;
use App\Thread;
use App\Reply;
use App\Channel;
use App\EmailList;
use App\MessageTemplate;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'administrator', function() {
   return [
       'name'=>'santa'
   ] ;
});


$factory->define(Thread::class, function (Faker $faker){
    return [
        'user_id'=> factory(User::class),
        'channel_id'=>factory(Channel::class),
        'title' =>$faker->sentence,
        'body' =>$faker->paragraph,
        'locked'=>false
    ];
});


$factory->define(Reply::class, function (Faker $faker){
    return [
        'user_id'=> factory(User::class),
        'thread_id'=>factory(Thread::class),
        'body' =>$faker->paragraph
    ];
});


$factory->define(Channel::class, function (Faker $faker){
    return [
        'name'=> $faker->word,
        'slug'=> $faker->word
    ];
});


$factory->define(\Illuminate\Notifications\DatabaseNotification::class, function (Faker $faker){
    return [
        'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
        'type' => 'App\Notifications\ThreadWasUpdated',
        'notifiable_id' => function() {
            return auth()->id() ?: factory('App\User')->create()->id;
        },
        'notifiable_type' => 'App\User',
        'data' => ['foo' => 'bar']
    ];
});


$factory->define(EmailList::class, function (Faker $faker){
    return [
        'user_id'=> factory(User::class),
        'title'=>$faker->sentence(2)
    ];
});


$factory->define(Emails::class, function (Faker $faker){
    return [
        'email_list_id'=> factory(EmailList::class),
        'email' => $faker->email,
        'token' => Str::random(10),
        'user_name'=> $faker->name,
        'organisation'=>$faker->sentence(5),
        'source'=>$faker->sentence(3)
    ];
});


$factory->define(MessageTemplate::class, function (Faker $faker){
    return [
        'template_title'=>$faker->sentence(3),
        // 'from' => $faker->email,
        'title'=> $faker->sentence(4),
        'theme'=>$faker->sentence(5),
        'body'=>$faker->sentence(50)
    ];
});

$factory->define(\App\Signature::class, function (Faker $faker){
    return [
        'signature_title'=>$faker->sentence(3),
        'name'=>$faker->name(),
        'position'=>$faker->sentence(2)
    ];
});

$factory->define(\App\SendLog::class, function (Faker $faker){
    return [
        'user_id'=> factory(User::class),
        'template_id'=>$template = factory(EmailList::class),
        'template_message'=>$template->body,
        'list_id'=> $list = factory(EmailList::class),
        'list_title'=>$list->title
    ];
});

$factory->define(InviteKey::class, function (Faker $faker){
    return [
        'user_id'=> factory(User::class),
        'email' => $faker->email,
        'key'=>Str::random(10),
    ];
});
