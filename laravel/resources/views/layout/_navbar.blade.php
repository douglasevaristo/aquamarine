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
                {!! utils::criar_navbar_item('Home', 'home') !!}
                <li ><a href="#">Postagens</a></li>
                {!! utils::criar_navbar_item('Sobre', 'sobre') !!}
                {!! utils::criar_navbar_item('Contato', 'contato') !!}
            </ul>
        </div>
    </div>
</nav>