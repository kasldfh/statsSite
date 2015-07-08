<h1>Users</h1>
@foreach ($users as $user)
    <article>
        <h2> {!! $user->name !!}</h2>
         {!! $user->email !!}
    </article>
@endforeach

