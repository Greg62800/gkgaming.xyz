<div class="sidebar">
    <h2>Rechercher</h2>
    <div class="search">
        {{ Form::open(['method' => 'GET', 'url' => route('blog.index')]) }}
        <input type="text" name="q" placeholder="Rechercher..." class="form-control">
        <button type="submit" class="icon">
            <i class="fa fa-search"></i>
        </button>
        {{ Form::close() }}
    </div>
</div>
<div class="sidebar">
    <h2>Catégories</h2>
    <div class="categories">
        {{ Form::open(['url' => route('blog.categories')]) }}
            {{ Form::select('categories', \App\Category::pluck('name', 'slug')) }}
            {{ Form::submit('GO') }}
        {{ Form::close() }}
    </div>
</div>