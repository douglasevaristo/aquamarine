<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">aquamarine</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                {!! utils::criar_navbar_item('Home', route('home')) !!}
                {!! utils::criar_navbar_item('Postagens', route('post.index')) !!}
                {!! utils::criar_navbar_item('Sobre', route('sobre')) !!}
                {!! utils::criar_navbar_item('Contato', route('contato')) !!}
            </ul>
        </div>
    </div>
</nav>