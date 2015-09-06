<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;

use Redirect;

use App\Models\Article;

class ArticleController extends Controller {

	public function index() {
		$articles = Article::latest('published_at')->published()->get();
		return view('articles.index', compact('articles'));
	}

	public function show($id) {
		$article = Article::findOrFail($id);
		return view('articles.show', compact('article'));
	}

	public function create() {
        //return 'lelele';
        $this->middleware('auth');
		return view('articles.create');
	}

	public function store(ArticleRequest $request) {
        //$this->middleware('auth');
		Article::create($request->all());
        dd('lele');
        return Redirect::action('ArticleController@index');
	}

	public function edit($id) {
        $this->middleware('auth');
		$article = Article::findOrFail($id);
		return view('articles.edit', compact('article'));
	}

	public function update($id, ArticleRequest $request) {
        $this->middleware('auth');
		$article = Article::findOrFail($id);
		$article->update($request->all());
		return redirect('articles');
	}

    public function delete($id) {
       Article::destroy($id);
       return redirect('articles');
    }

    public function manage() {
        $this->middleware('auth');
        $articles = Article::all();
        return view('articles.manage', compact('articles'));
    }
}
