@extends('articles.app')
@section('content')
    <h1>Manage Articles</h1>
    <hr/>
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Published at</th>
                <th>Edit Article</th>
                <th>Delete Article</th>
            </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
        <tr>
            <td>{!!$article->title!!}</td>
            <td>{!!$article->published_at!!}</td>
            <td>{!!link_to_action('ArticleController@edit', 'Edit', ['id' => $article->id], ['class' => 'btn btn-default'])!!}</td>
            <td>{!!link_to_action('ArticleController@delete', 'Delete', ['id' => $article->id], ['class' => 'btn btn-danger'])!!}</td>
        </tr>
        @endforeach
    </table>
@endsection
